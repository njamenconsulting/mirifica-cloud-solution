<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;

Class MouserRepository
{
    const BASE_URL ="https://api.mouser.com/api/";
    
    /**
     * _curlService
     *
     * @var mixed
     */
    private $_curlService;   
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->_curlService = new CurlService();
    }  
    /**
     * getPartsByKeyword
     *
     * @param  mixed $array
     * @return json string 
     */
    public function getPartsByKeyword($array)
    {
        //on recupère (couper) le dernier element du tableau 
        $version = array_pop($array);
        $data['SearchByKeywordRequest'] = $array;
      
        $url = 'https://api.mouser.com/api/'.$version.'/search/keyword?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70';

        $fields = json_encode($data);

        $header = array('Content-Type: application/json');

        return $this->_curlService->postRequest($url, $fields, $header);

    }
    //
    public function getmanufacturerlist()
    {
        $url = "https://api.mouser.com/api/v2/search/manufacturerlist?apiKey=a76659c5-f632-4836-bf84-8b8c507dcc70";
        return $this->_curlService->getRequest($url);
    }
}