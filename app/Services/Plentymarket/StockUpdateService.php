<?php
namespace App\Services\Plentymarket;

use App\Repositories\PlentymarketRepository;

class StockUpdateService
{
    private $_plentymarketRepository;

    function __construct(PlentymarketRepository $plentymarketRepository)
    {
        $this->_plentymarketRepository = $plentymarketRepository;      
    } 
    
    /**
     * updateStock
     *
     * @param  mixed $pmData
     * @return array
     */
    public function updateStock($pmData):array
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
   