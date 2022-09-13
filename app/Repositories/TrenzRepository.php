<?php

namespace App\Repositories;

use App\Services\CurlService;
//use App\Services\TokenService;
use Illuminate\Support\Facades\Http;

Class TrenzRepository
{
    const BASE_URL ="https://shop.trenz-electronic.de/api/";
    private $_header;
    private $_TokenService;
    private $_curlService;

    public function __construct(){

      $this-> _header =  ['Content-Type: application/json;charset=utf-8',
                          'Authorization: Basic bWlyaWZpY2EtYXBpOnAwcGRzQ3FHV1FEblJlRXk4NUtuSzh5Q0NBd1JRcEVobjZuTlNDb20='
                         ];
    }
    
    //
    public function getArticle($articleId)
    {

        $method = "GET";

        $url = self::BASE_URL."articles/".$articleId."?language=2";

        $article = CurlService::makeHttpRequest($method, $url,$this-> _header,[]);

        return $article;                                                                                  
    }
  
    public function getDataFromTrenz($data){

        $url = self::BASE_URL."articles/".$data['externalId']."?language=2";

        $method = "GET";

        $fields = [
                    'filter' => ['mainDetail' => [  
                                                    [ 'property'=>'inStock','value'=>1 ],
                                                    [ 'property'=>'active','value'=>1 ]
                                                  ]
                                ]            
                ];

        return CurlService::makeHttpRequest($method, $url,$this-> _header,$fields);

      }


}