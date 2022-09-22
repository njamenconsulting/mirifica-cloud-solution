<?php

namespace App\Repositories;

use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;
use App\Repositories\{PlentymarketRepository,TrenzRepository};
use App\Repositories\Api\Plentymarket\PlentymarketApiArticleRepository;

Class UpdatePMArticleFromTrenzData
{
    private $_plentymarketRepository;
    private $_trenzRepository;
   
    function __construct(PlentymarketApiArticleRepository $plentymarketRepository)
    {
        $this->_plentymarketRepository = $plentymarketRepository;
        $this->_trenzRepository = new TrenzRepository();
    } 

    public function updatePrice(){

        $filename = public_path('files/variationIndentification.csv');
 
        $assoc_array = [];
    
        if (($handle = fopen($filename, "r")) !== false) {                 // open for reading
            if (($data = fgetcsv($handle, 1000, ",")) !== false) {         // extract header data
                $keys = $data;                                             // save as keys
            }
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {      // loop remaining rows of data
                if(count($keys) == count($data)){
                  $assoc_array[] = array_combine($keys, $data);              // push associative subarrays
                } else{
                  dd($keys, $data); 
                    echo "The arrays have unequal length \n";
                }
            }
            fclose($handle);                                               // close when done
        }
    
        for ($i=0; $i < count($assoc_array); $i++) { 
          //dd($assoc_array[$i]);
          //get externalID from PM
          //dd($assoc_array[$i]);
          $externaID = $this->_plentymarketRepository->getExternalId($assoc_array[$i]);
          //dd($assoc_array[$i],$externaID);
          //retrieve data from Trenz
          $data = $this->_trenzRepository->getDataFromTrenz($externaID);
          //dd($assoc_array[$i],$data);
          $data['variationId'] = $assoc_array[$i]['variationId'];
          $data['salePriceId'] = 1;
    
          //update variation in PM
          $this->_plentymarketRepository->updateSalePrice($data);
        }
    }
    
}