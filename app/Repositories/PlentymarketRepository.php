<?php

namespace App\Repositories;

use App\Services\CurlService;
use App\Services\TokenService;
use Illuminate\Support\Facades\Http;

Class PlentymarketRepository
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
    public function updateSalePrice($data):array
    {
        # price Gross calculation by adding VAT of 19%
        $priceGross = $data['price'] + $data['price'] * $this->_vat;

        $url = $this->_url."/rest/items/variations/variation_sales_prices";

        $fields = [
              [
                'variationId' => $data['variationId'],
                'salesPriceId' => $data['salePriceId'],
                'price' => $priceGross
              ]
        ];
        
        $method = "PUT";

        $update = CurlService::makeHttpRequest($method, $url, $this-> _header,$fields);  

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