<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CurlService;
use App\Services\TokenService;
use Illuminate\Support\Facades\DB;

class PlentySystemController extends Controller
{
    private $_url;
    private $_vat;
    private $_header;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

      $this->_url = config('plentymarket.BASE_URL');

      $this->_vat = config('plentymarket.VAT');

      $this->_header =  [
                          'Content-Type: application/json;charset=utf-8',
                          'Authorization: Bearer '.(new TokenService())->getAccessToken()
                         ];
    }

    public function getAllItems()
    {
        $url = $this->_url."/rest/items";
        $method = "GET";      
        $items = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);
        
        return $items;
    }
    public function getAllVariations(int $pageNumber)
    {
        $url = $this->_url."/rest/items/variations?page=".$pageNumber;
        $method = "GET";      
        $variations = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);
        
        return $variations;
    }  
    /**
     * getExternalId
     *
     * @param  mixed $data
     * @return array
     */
    public function getExternalId($itemId, $variationId)
    {
      
        $url = $this->_url."/rest/items/".$itemId."/variations/".$variationId;
        $method = "GET";      
        $variation = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);

        //Return extracted externalId value
       // return array('externalId' => $variation['externalId']);
        return $variation['externalId'];
    }
        
    /**
     * updateSalePrice
     *
     * @param  mixed $data
     * @return array
     */
    public function updateSalePrice():array
    {
        $variations = DB::select('select * from plentyarticles where externalId IS NOT NULL'); 

        foreach ($variations as $key => $value) {
            # price Gross calculation by adding VAT of 19%
            if(is_numeric($value->price))
            {            
                $priceGross = $value->price + $value->price * $this->_vat;

                $url = $this->_url."/rest/items/variations/variation_sales_prices";

                $fields = [
                    [
                        'variationId' => $value->variationId,
                        'salesPriceId' => 1,
                        'price' => $priceGross
                    ]
                ];
                
                $method = "PUT";
        
                $update = CurlService::makeHttpRequest($method, $url, $this-> _header,$fields); 
            }

        }
        dd($update);
        return $update; 

    }

     
     /**
      * updateStock
      *
      * @param  mixed $data
      * @return array
      */
     public function updateStock($data):array
     {

        $url = $this->_url."/rest/items/". $data['itemId'] ."/variations/". $data['variationId'] ."/stock/correction";
        
        $fields = [
            'quantity' => $data['stockTrenz'],
            'warehouseId' => 1,
            'storageLocationId' => 0,
            'reasonId' => 301
        ];
        
        $method = "PUT";

        $update = CurlService::makeHttpRequest($method, $url,$this-> _header,$fields); 

        return $update;
     }
}
