<?php
namespace App\Services\Plentymarket;

use App\Repositories\PlentymarketRepository;

class PlentymarketUpdatingService
{
    function __construct()
    {
        $this->_plentymarketRepository = new PlentymarketRepository();      
    } 

    public function runSalePriceUpdate($data)
    {
            //update variation in PM
        $a =$this->_plentymarketRepository->updateSalePrice($data);

    }
    public function runStockUpdate($data)
    {           
            //update variation in PM
        $b=$this->_plentymarketRepository->updateStock($data);
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
    public function updateStock($pmData)
    {     
        $reportData =  array();
        for ($i=0; $i < count($pmData); $i++) { 
         
            $dataForUpdating = array();#Data which wwill use to make updating requests

            $dataForUpdating = [
                
                'itemId' => $pmData[$i]['itemId'],
                'variationId' => $pmData[$i]['variationId'],
                'salePriceId' => 1,
                #'price' =>  $pmData[$i]['price'],
                'stock' => $pmData[$i]['stock']              
            ];

            //update variation in PM
           // $a =$this->_plentymarketRepository->updateSalePrice($dataForUpdating);

            $reportData[$i] = $dataForUpdating;
           
            echo 'Variation '.$dataForUpdating['variationId'].' price updating completed successfully'.'<br/>';
        }
     
        return $reportData;
    }
}
   