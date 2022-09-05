<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;

Class Element14Repository
{
    const BASE_URL = 'https://api.element14.com/catalog/products';

    private $_curlService;
    //
    public function __construct()
    {
        $this->_curlService = new CurlService();
    }
    //Returns Product information based on a search by keyword
    public function keywordSearch($array)
    {
 
        $query = "versionNumber=1.2&term=any:".$array['keyword']."&storeInfo.id=".$array['storeInfo']."&resultsSettings.offset=".$array['startingOffset']."&resultsSettings.numberOfResults=".$array['numberOfResults']."&resultsSettings.refinements.filters=".$array['filters']."&resultsSettings.responseGroup=".$array['responseGroup']."&callInfo.responseDataFormat=JSON&callinfo.apiKey=ds7jb83h2q2hdteqbq5f9fra";
        $url = self::BASE_URL."?".$query;

        return $this->_curlService->getRequest($url);
    }
    //
    public function searchByManufacturerPartNumber()
    {
        //
    }
}