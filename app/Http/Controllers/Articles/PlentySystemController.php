<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Plentymarket\PlentyApiService;
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
    public function __construct(plentyApiService $plentyApiService)
    {
      $this -> _plentyApiService = $plentyApiService;
      $this->_url = config('plentymarket.BASE_URL');

      $this->_vat = config('plentymarket.VAT');

      $this->_header =  [
                          'Content-Type: application/json;charset=utf-8',
                          'Authorization: Bearer '.(new TokenService())->getAccessToken()
                         ];
    }
    /**
     * updateSalePrice
     *
     * @param  mixed $data
     * @return array
     */
    public function updateSalePrice():array
    {

        $variations = DB::select('SELECT * FROM item_to_updates');
        $fields =array();
        for ($i=0; $i < count($variations) ; $i++) { 
    
                //$priceGross = $variations[$i]->price + $variations[$i]->price * $this->_vat;
                    
            $field = [
                'variationId' => $variations[$i]->variationId,
                'salesPriceId' => 1,
                'price' => 2
            ];
       
            $fields[0] = $field;
            if($i!=0) $fields[$i] = array_merge($fields[$i-1], $field);
  
        }
        
dd(json_encode($fields));
        foreach ($variations as $key => $value) {
            
            # price Gross calculation by adding VAT of 19%
            if(is_numeric($value->price))
            {    
                     
                $priceGross = $value->price + $value->price * $this->_vat;

                $url = $this->_url."/rest/items/variations/variation_sales_prices";
    #Updates up to 50 prices of variations. The ID of the variation, the ID of the sales price and a price must be specified.
#The unique ID of the variation
#The unique ID of the sales price
#The price of the variation saved for this sales price

/*Updates up to 50 variations. The ID of the variation must be specified.
/rest/items/variations*/


                $fields = [
                    [
                        'variationId' => $value->variationId,
                        'salesPriceId' => 1,
                        'price' => $priceGross
                    ]
                ];
                
                $method = "PUT";
                //dd($method, $url, $this-> _header,$fields);   
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
