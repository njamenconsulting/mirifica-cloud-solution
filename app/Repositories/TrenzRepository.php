<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;

Class TrenzRepository
{
    const BASE_URL ="https://shop.trenz-electronic.de/";
    
    //
    public function getArticle(){

        $url = self::BASE_URL."api/articles?language=2";
                                                                                  
        $certificate_location = public_path('certs/cacert.pem');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.trenz-electronic.de/api/articles/2080?language=2',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_SSL_VERIFYHOST=> $certificate_location,
          CURLOPT_SSL_VERIFYPEER=> $certificate_location,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS =>'{
            "filter": [
                  {
                    "mainDetail":
                                {
                                    "property": "inStock",
                                    "value": 1
                                }
                },
                {
                    "property": "active",
                    "value": 1
                }
            ]
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
          ),
        ));
        
        //Execute cURL and return the string. depending on your resource this returns output like
        if(curl_exec($curl) === false) 
           dd('Erreur Curl : ' . curl_error($curl));
        else $response = curl_exec($curl);
        
        curl_close($curl);
        
        //dd($response);
        
        return $response;
    }
########################################
public function getDataFromTrenz($data){
    $certificate_location = public_path('certs/cacert.pem');
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.trenz-electronic.de/api/articles/'.$data['externalId'].'?language=2',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_SSL_VERIFYHOST=> $certificate_location,
      CURLOPT_SSL_VERIFYPEER=> $certificate_location,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_POSTFIELDS =>'{
        "filter": [
              {
                "mainDetail":
                            {
                                "property": "inStock",
                                "value": 1
                            }
            },
            {
                "property": "active",
                "value": 1
            }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
      ),
    ));
    
    //Execute cURL and return the string. depending on your resource this returns output like
    if(curl_exec($curl) === false) 
      dd('Erreur Curl : ' . curl_error($curl));
    else $response = curl_exec($curl);
    
    curl_close($curl);
    
    $trenzData = json_decode($response,true);
    //Retrieving id, price,etc of product from Trenz platform
    $trenzExtractedData = array('productIdTrenz' => $trenzData['data']['id'] ,
                                'stockTrenz' => $trenzData['data']['mainDetail']['inStock'],
                                'priceTrenz' =>  $trenzData['data']['mainDetail']['prices'][0]['price'] );
    
    return $trenzExtractedData;
  }


}