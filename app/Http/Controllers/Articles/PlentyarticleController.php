<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Plentymarket\PlentyApiService;
use App\Models\Plentyarticle;
use Illuminate\Support\Facades\DB;

class PlentyarticleController extends Controller
{
    public $_plentyApiService;
    private $_plentyModel;

    function __construct(PlentyApiService $plentyApiService,Plentyarticle $plentyModel)
    {
        $this -> _plentyApiService = $plentyApiService;
        $this -> _plentyModel = $plentyModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = DB::select('SELECT * FROM plentyarticles');

        return view('plentyarticles.plenty_dashboard', ['data' => $variations]);
    }

    /**
     * Retrieve variation from Plenty market API and store it into db
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $start = microtime(true); 
        $memoryBefore = memory_get_usage(true);

        $variations = $this -> _plentyApiService ->getAllVariations(1);

        $allVariations = array();
        $allVariations[0]= $variations ;
        $totalPage = $variations['lastPageNumber'];
        
        for ($i=1; $i < $totalPage; $i++) { 
     
            $pageNumber=$i+1;

            $variations = $this -> _plentyApiService ->getAllVariations($pageNumber);
      
            $allVariations[$i]= array_merge($allVariations[$i-1],$variations) ;                    

        }

        foreach ($allVariations as $page => $variations) {

            $result = $this->store($variations['entries']);
        }

        $end = microtime(true); 
        $memoryAfter = memory_get_usage(true);
        $during = ($end - $start);
        $consuming = ($memoryAfter - $memoryBefore); 
        $consuming = $consuming/1000000;

        $variations = DB::select('SELECT * FROM plentyarticles WHERE externalId IS NOT NULL');

        return view("plentyarticles.plenty_create", ['data'=>count($variations),'time'=>$during ,'memory'=>$consuming]);
    }

    /**
     * Store a newly created variation in sqlite database.
     *
     * @param  Array $data
     * @return \Illuminate\Http\Response
     */
    public function store(Array $data)
    {
   
        foreach ($data as $key => $value) {

            try {
                $query = DB::insert('insert into plentyarticles (itemId, variationId, externalId, warehouseVariationId, price, priceGross, stock, created_at)
                values (?, ?, ?, ?, ?, ?, ?, ?)', [$value['itemId'], $value['id'],$value['externalId'],$value['warehouseVariationId'],'nan','nan','nan',date("Y-m-d H:i:s")]);

            } catch (\Throwable $th) {
                throw $th;
            }
        }
   
        return $query;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = DB::select('select * from trenzarticles'); 
      

        foreach ($articles as $article) {
            
            $variation = DB::select('select * from plentyarticles where externalId = :id', ['id' => $article->productId]);
       
            if($variation)
            { 

                if($article->price != $variation[0]->price ){

                    $query = $this->update($article,$variation[0]->externalId);#   
                }

                if($article->stock != $variation[0]->stock){

                    $affected = DB::update('UPDATE plentyarticles 
                                            SET stock = ? , updated_at = ? 
                                            WHERE externalId  = ?', [$article->stock, date("Y-m-d H:i:s"), $article->productId]
                                        );

             
                if($affected) $updatedVariation  = DB::select('select * from plentyarticles where externalId = :id', ['id' => $article->productId]);

                $query = DB::insert('INSERT INTO variation_to_update_stocks (itemId, variationId, externalId, stock, created_at)
                                VALUES (?, ?, ?, ?, ?)',  
                                [$updatedVariation[0]->itemId , $updatedVariation[0]->variationId , $updatedVariation[0]->externalId , $updatedVariation[0]->stock,date("Y-m-d H:i:s")]
                            );
                     
                }
            }
            /*
            else{

                $query = $this->store( (array) $article);
                if($query)  $report['itemAdded'][$article->productId] = $article;
            }
            */
   
        }
        $variations = DB::select('SELECT * FROM variation_to_update_prices');
        return view('plentyarticles.plenty_update', ['variations' => $variations]);
    }

    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return int
     */
    public function update($data, $id):int
    {
        $priceGross = $data->price*config('plentymarket.VAT') + $data->price;
        //on met à jour la table plentymarkets

        $affected = DB::update('UPDATE plentyarticles 
                                SET price = ? , priceGross = ?, updated_at = ? 
                                WHERE externalId  = ?', [$data->price , $priceGross,date("Y-m-d H:i:s"),$id]
                            );
    

        if($affected) $updatedVariation  = DB::select('select * from plentyarticles where externalId = :id', ['id' => $data->productId]);

        $query = DB::insert('INSERT INTO variation_to_update_prices (itemId, variationId, externalId, price, created_at)
                            VALUES (?, ?, ?, ?, ?)',  
                            [$updatedVariation[0]->itemId , $updatedVariation[0]->variationId , $updatedVariation[0]->externalId , $updatedVariation[0]->price,date("Y-m-d H:i:s")]
                        );

        return true;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
