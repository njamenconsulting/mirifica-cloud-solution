<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Plentymarket\PlentyApiService;
use App\Services\CurlService;
use App\Services\TokenService;
use App\Helpers\ArrayToCsvHelper;
use Illuminate\Support\Facades\DB;

class PlentySystemController extends Controller
{
    private $_url;
    private $_vat;
    private $_header;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(plentyApiService $plentyApiService)
    {
      $this -> _plentyApiService = $plentyApiService;

      $this->_url = config('plentymarket.BASE_URL');

      $this->_vat = config('plentymarket.VAT');

      $this->_header =  [
                          'Content-Type: application/json;charset=utf-8',
                          'Authorization: Bearer '.(new TokenService())->getAccessToken()
                         ];
    }
    /**
     * updateSalePrice
     *
     * @param  mixed $data
     * @return array
     */
    public function updateSalePrice():bool
    {

        $variations = DB::select('SELECT * FROM variation_to_update_prices');
        $fields =array();

        $bulkIteration = ceil(count($variations)/50);

        for ($i=0; $i < $bulkIteration; $i++) { 

            for ($j=0; $j < 50; $j++) { 
                # price Gross calculation by adding VAT of 19%
                $priceGross = $variations[$j]->price + $variations[$j]->price * $this->_vat;
                        
                $field = [
                    'variationId' => $variations[$j]->variationId,
                    'salesPriceId' => 1,
                    'price' => round($priceGross,2)
                ];
        
                $fields[0] = $field;
                if($j!=0) $fields[$j] = array_merge($fields[$j-1], $field);
            }

            $this -> _plentyApiService ->updateSalePrice($fields);

            ArrayToCsvHelper::createCsvFileFromArray("price_update_report",$fields,false,";");
        }
        
        return true;
    }
     
     /**
      * updateStock
      *
      * @param  mixed $data
      * @return array
      */
     public function updateStock($data):array
     {

        $url = $this->_url."/rest/items/". $data['itemId'] ."/variations/". $data['variationId'] ."/stock/correction";
        
        $fields = [
            'quantity' => $data['stockTrenz'],
            'warehouseId' => 1,
            'storageLocationId' => 0,
            'reasonId' => 301
        ];
        
        $method = "PUT";

        $update = CurlService::makeHttpRequest($method, $url,$this-> _header,$fields); 

        return $update;
     }
}
