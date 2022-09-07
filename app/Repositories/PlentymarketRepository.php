<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;

Class PlentymarketRepository
{
    const BASE_URL ="https://wy04olnc8o0q.c01-16.plentymarkets.com";

    public function getExternalId($data,$token){
  
        $curl = curl_init();
        $certificate_location = public_path('certs/cacert.pem');
        
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://wy04olnc8o0q.c01-16.plentymarkets.com/rest/items/".$data['itemId']."/variations/".$data['variationId'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST=> $certificate_location,
          CURLOPT_SSL_VERIFYPEER=> $certificate_location,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_COOKIE => "plentyID=eyJpdiI6IkdHcURHTVd0R2FBS0FnZTFVSEpNN0E9PSIsInZhbHVlIjoidE9jbzlQUDgxcm9SSnlsczMxcUFIUW9PVHFIdEVDS2lVTkFFTm4rY2dYTU5WRWdNRmNCNk83alwvdHU0SlZlS0oiLCJtYWMiOiJlODAxZDM2YmYyZDc3NmIzODE1OWJiN2I0ZDBkMjM4ZjU3MGYzY2IzODU0NjQ2YmNmYTRkY2RmYjBiYWE0NmFiIn0%253D",
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".$token
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
          $trenzData = json_decode($response,true);
          //Retrieving id, price,etc of product from Trenz platform
          $trenzExtractedData = array('externalId' => $trenzData['externalId']);
          
          return $trenzExtractedData;
        }
        
    
      }
    
    public function updateSalePrice($data,$token){

        $priceGross = $data['priceTrenz']*0.19;

        $certificate_location = public_path('certs/cacert.pem');
        $curl = curl_init();
 
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://wy04olnc8o0q.c01-16.plentymarkets.com/rest/items/variations/variation_sales_prices",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST=> $certificate_location,
          CURLOPT_SSL_VERIFYPEER=> $certificate_location,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_POSTFIELDS => "[\n\t{\n\t\t\"variationId\": ".$data['variationId'].",\n\t\t\"salesPriceId\": ".$data['salePriceId']. ",\n\t\t\"price\": ".$priceGross. "\n  }\n]\n",
          CURLOPT_COOKIE => "plentyID=eyJpdiI6Im9PSzBQQ2R0c0g2ZFB6ckxiVVBxQVE9PSIsInZhbHVlIjoiQUluWTl3ZkNFV2RiV2dvZ0lzTWpOMWN6cDRuUUdMMTdiS2dmN2Y0WTJVZkd1XC9GcU5VV3crRHJcL1k4TzZVOEJnIiwibWFjIjoiODkwNjQ0NTFjYTM1MWZlMzQ3NzkzNTAxNjMxMTdkYTlmNTUxMmExMWU4NTcyNDE1NGI4Y2ZkYzkwMjkxZGY0OCJ9",
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer ".$token,
            "Content-Type: application/json"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
 
     }

     ################################
     public function updateStock($data,$token){
 
       $curl = curl_init();
       
       curl_setopt_array($curl, [
         CURLOPT_URL => "https://wy04olnc8o0q.c01-16.plentymarkets.com/rest/items/". $data['itemId'] ."/variations/". $data['variationId'] ."/stock/correction",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "PUT",
         CURLOPT_POSTFIELDS => "{\n  \"quantity\": ".$data['stockTrenz'].",\n  \"warehouseId\": 1,\n  \"storageLocationId\": 0,\n  \"reasonId\": 301\n}",
         CURLOPT_COOKIE => "plentyID=eyJpdiI6IlwvVU1qZ1NQVmNyK3ZPZFNQOWI4QitnPT0iLCJ2YWx1ZSI6Im5qSG9JeithcEhGUkk4NmR4NnpvQWRkcmRxZ3RQMHFcL2VraWFGU1RjQVlnN2hsOXVzRXhNT0FCamNock82WnNBIiwibWFjIjoiZThmMGI1YzExNzlhMjg3MjNiZWJmODZjZTU0MjBjMjU1OGQ0M2U1ZmQwMzQ1NzIxYjIxMzJiYmY5OTRkYThmOCJ9",
         CURLOPT_HTTPHEADER => [
           "Authorization: Bearer ".$token,
           "Content-Type: application/json"
         ],
       ]);
       
       $response = curl_exec($curl);
       $err = curl_error($curl);
       
       curl_close($curl);
       
       if ($err) {
         echo "cURL Error #:" . $err;
       } else {
         return $response;
       }
     }
     ##########################################
     public function updateBulkStock(){
 
       $curl = curl_init();
       
       curl_setopt_array($curl, [
         CURLOPT_URL => "https://wy04olnc8o0q.c01-16.plentymarkets.com/rest/stockmanagement/warehouses/1/stock/correction",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "PUT",
         CURLOPT_POSTFIELDS => "{\n    \"corrections\": [\n       {\n            \"variationId\": 2899,\n            \"quantity\": 36,\n            \"storageLocationId\": 0\n        }\n\t\t]\n}",
         CURLOPT_COOKIE => "plentyID=eyJpdiI6IlwvVU1qZ1NQVmNyK3ZPZFNQOWI4QitnPT0iLCJ2YWx1ZSI6Im5qSG9JeithcEhGUkk4NmR4NnpvQWRkcmRxZ3RQMHFcL2VraWFGU1RjQVlnN2hsOXVzRXhNT0FCamNock82WnNBIiwibWFjIjoiZThmMGI1YzExNzlhMjg3MjNiZWJmODZjZTU0MjBjMjU1OGQ0M2U1ZmQwMzQ1NzIxYjIxMzJiYmY5OTRkYThmOCJ9",
         CURLOPT_HTTPHEADER => [
           "Authorization: Bearer ".$token,
           "Content-Type: application/json"
         ],
       ]);
       
       $response = curl_exec($curl);
       $err = curl_error($curl);
       
       curl_close($curl);
       
       if ($err) {
         echo "cURL Error #:" . $err;
       } else {
         echo $response;
       }
     }
     public function token(){
        $curl = curl_init();
//$value = config('app.timezone');$env = env('APP_ENV', 'production');
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://wy04olnc8o0q.c01-16.plentymarkets.com/rest/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n  \"username\": \"YvesANN\",\n  \"password\": \"P@ssw0rd2022\"\n}",
        CURLOPT_COOKIE => "plentyID=eyJpdiI6ImJXVm9cL1U2RXNpeE1PUThhbWJ5UU53PT0iLCJ2YWx1ZSI6InZuemJmTUVUSjMwOHA3dEhyXC9yZ3ltVTJBUWMrYmV0aUhua3hFVGRxWTFpWHB6VDZROUthRkRsQUxEUW93emdPIiwibWFjIjoiZGI0YzYwN2Y3ZjlhNmE3ZTQ5OWI2YzRjOTRmMWJmMTk0Mjc1ZTU3ZmI0MGQ1N2I4MGQ4NDM2NGQxYzRkY2FhMyJ9",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        return $response;
        }
     }
}