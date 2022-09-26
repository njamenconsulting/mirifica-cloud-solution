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

    function __construct(plentyApiService $plentyApiService,Plentyarticle $plentyModel)
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
        return view('plentyarticles.plenty_dashboard');
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
        //
        $i=1;
        $isLastPage = false;
        //
        while (!$isLastPage) {

            $pageOfVariation = $this -> _plentyApiService ->getAllVariations($i);

            $allVariations[$i] = $pageOfVariation;
            
            if($i!=1)
            {
                $allVariations[$i]= array_merge($allVariations[$i-1],$pageOfVariation) ;                
            }

            $isLastPage = $pageOfVariation['isLastPage'];

            echo $i."<br>";
            $i++;
        }
        $end = microtime(true); 
        $memoryAfter = memory_get_usage(true);
        $during = ($end - $start);
        $consuming = ($memoryAfter - $memoryBefore);
        echo " Execution time: ".$during." sec   <br>"; 
        $consuming = $consuming/1000000;
        echo " Memory consumtion: ".$consuming." Mo   <br>";
       
        foreach ($allVariations as $page => $variations) {
           // dd($allVariations);
            $this->store($variations['entries']);
        }
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

            $query = DB::insert('insert into plentyarticles (itemId, variationId, externalId, warehouseVariationId, price, priceGross, stock, created_at)
                                    values (?, ?, ?, ?, ?, ?, ?, ?)', [$value['id'], $value['itemId'],$value['externalId'],$value['warehouseVariationId'],'nan','nan','nan',date("Y-m-d H:i:s")]);
        }
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
                    if($query)  $report['itemUpdated'][$article->productId] = $article;
                }
            }
            /*
            else{

                $query = $this->store( (array) $article);
                if($query)  $report['itemAdded'][$article->productId] = $article;
            }
            */
   
        }

        return view('plentymarkets.index') ->with('variations', $report);
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
        //on met à jour la table plentymarkets
        $affected = DB::update('update plentyarticles set price = '.$data->price.',updated_at'.date("Y-m-d H:i:s").' where externalId = ?',[$id]);

        return $affected;
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
