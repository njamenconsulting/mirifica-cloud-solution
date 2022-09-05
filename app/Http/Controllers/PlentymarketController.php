<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Curl\CurlService;
use Illuminate\Support\Facades\Http;
use App\Repositories\{PlentymarketRepository,TrenzRepository};

class PlentymarketController extends Controller
{
    private $_plentymarketRepository;
    private $_trenzRepository;
   
    function __construct()
    {
        $this->_plentymarketRepository = new PlentymarketRepository();
        $this->_trenzRepository = new TrenzRepository();
    } 

    public function index(){

        info('Some helpful information!');
    }

    public function updatePriceAndStock()
    {
        //get acccess token for authenticating PM requests
        $json = $this->_plentymarketRepository->token();
        $array = json_decode($json,true);

        $filename = public_path('csv_files/variations_data.csv');
 
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
    
            //get externalID from PM
            $externaID = $this->_plentymarketRepository->getExternalId($assoc_array[$i],$array['access_token']);
            
            //retrieve data from Trenz linked to externalID(that mapping to productId in Trenz data)
            $data = $this->_trenzRepository->getDataFromTrenz($externaID);
        
            $data['itemId'] = $assoc_array[$i]['itemId'];
            $data['variationId'] = $assoc_array[$i]['variationId'];
            $data['salePriceId'] = 1;
        
            //update variation in PM
            $a =$this->_plentymarketRepository->updateSalePrice($data,$array['access_token']);
            //update variation in PM
            $b=$this->_plentymarketRepository->updateStock($data,$array['access_token']);
        
            echo 'Variation '.$data['variationId'].' price and stock update completed successfully';
        }
    }
}
