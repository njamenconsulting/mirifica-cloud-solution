<?php
namespace App\Services\Plentymarket;

use App\Repositories\PlentymarketRepository;

class PriceUpdateService
{
    function __construct()
    {
        $this->_plentymarketRepository = new PlentymarketRepository();      
    } 

    public function updatePrice($pmData)
    {     
        //dd($pmData);
        foreach ($pmData as $key => $value) {

            $dataForUpdating = array();#Data which wwill use to make updating requests

            $dataForUpdating = [
                
                'itemId' =>  $value['itemId'],
                'variationId' =>  $value['variationId'],
                'salePriceId' => 1,
                'price' =>   $value['price'],
                'priceGross' =>   $value['price']*1.19,
                #'stock' =>  $value['stock']              
            ];

            //update variation in PM
           // $affected =$this->_plentymarketRepository->updateSalePrice($dataForUpdating);

           // echo 'Variation '.$dataForUpdating['variationId'].' price updating completed successfully'.'<br/>';
        }
     
        //return $affected;
    }

}
   