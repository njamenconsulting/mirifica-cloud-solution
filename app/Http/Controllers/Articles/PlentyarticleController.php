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
            //   $variation['itemId']  $variation['isActive']   $variation['externalId']
            //$variation['mainWarehouseId']
            //dd($value['id'], $value['itemId'],$value['externalId']);
            $query = DB::insert('insert into plentyarticles (itemId, variationId,externalId, price, priceGross, stock)
                                    values (?, ?, ?, ?, ?, ?)', [$value['id'], $value['itemId'],$value['externalId'],'nan','nan','nan']);
        }
        dd($query);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
