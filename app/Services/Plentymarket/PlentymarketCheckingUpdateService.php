<?php
namespace App\Services\Plentymarket;

use App\Repositories\PlentymarketRepository;
use Illuminate\Support\Facades\DB;

class PlentymarketCheckingUpdateService
{
    public function checkPrice():array
    {
        $pmData = DB::select('select * from plentymarkets'); 

        $i=0;
        $updateData = array();

        foreach ($pmData as $variation) {

            $product = DB::select('select * from trenzs where productId = :id', ['id' => $variation->externalId]);
      
            if($product)
            { 
                if($variation->price != $product[0]->price ){

                    //on met à jour la table plentymarkets
                    $affected = DB::update(
                        'update plentymarkets set price = '.$product[0]->price.' where externalId = ?',
                        [$product[0]->productId]
                    );

                    $updateData[$i]['itemId'] = $variation->itemId;
                    $updateData[$i]['variationId'] = $variation->variationId;
                    $updateData[$i]['externalId'] = $variation->externalId;
                    $updateData[$i]['stock'] =$product[0]->stock;
                    $updateData[$i]['price'] = round($product[0]->price, 2);
                    $updateData[$i]['priceGross'] =round($product[0]->price*1.19,2);
                    
                }
            }
            $i++;
           
        }
  
        return $updateData;
    }
    //
    public function checkStock():array
    {
        $pmData = DB::select('select * from plentymarkets'); 

        $i=0;
        $updateData = array();
        
        foreach ($pmData as $variation) {

            $product = DB::select('select * from trenzs where productId = :id', ['id' => $variation->externalId]);
                    
            if($product)
            { 
                if($variation->stock != $product[0]->stock){
                    //on met à jour la table plentymarkets
                    $affected = DB::update(
                        'update plentymarkets set stock = '.$product[0]->stock.' where variationId = ?',
                        [$variation->externalId]
                    );

                    $updateData[$i]['itemId'] = $variation->itemId;
                    $updateData[$i]['variationId'] = $variation->variationId;
                    $updateData[$i]['stock'] =$product[0]->stock;
                    
                }
            }
            $i++;
        }

        return $updateData;
    }
}