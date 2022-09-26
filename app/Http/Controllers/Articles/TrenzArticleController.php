<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Trenz\TrenzApiService;
use App\Models\Trenzarticle;
use Illuminate\Support\Facades\DB;

class TrenzarticleController extends Controller
{
    public $_trenzApiService;
    private $_trenzModel;

    function __construct(TrenzApiService $trenzApiService,Trenzarticle $trenzModel)
    {
        $this -> _trenzApiService = $trenzApiService;
        $this -> _trenzModel = $trenzModel;
    }
    /** 
     * Display the Trenz dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trenzarticles.trenz_dashboard');
    }

    /**
     * Retrieve articles from Trenz using API,and store it in trenzarticle table. INITIALISATION STEP
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $start = microtime(true); 
        $memoryBefore = memory_get_usage(true);

        #retrieving all articles from Trenz
        $articles1 = $this -> _trenzApiService->getAllArticle(0);
        
        if($articles1['success'])
        {
          #In the where the number product is sup to 1000, limit of Trenz         
          if( $articles1['total'] != count($articles1['data'])) 
          {
            $offset =  count($articles1['data'])+1;

            $articles2 = $this -> _trenzApiService->getAllArticle($offset);

            if($articles2['success']){
                
                $articles['data'] =array_merge($articles1['data'],$articles2['data']);

                $this-> store($articles['data']);
            }   
          }
          else          
            $this-> store($articles['data']);
        }

        $end = microtime(true); 
        $memoryAfter = memory_get_usage(true);
        $during = ($end - $start);
        $consuming = ($memoryAfter - $memoryBefore);
        echo " Execution time: ".$during." sec   <br>"; 
        $consuming = $consuming/1000000;
        echo " Memory consumtion: ".$consuming." Mo   <br>";

        return view("trenzarticles.trenz_dashboard");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($articles)
    {
        //ini_set('max_execution_time', 120);
        foreach ($articles as $key => $value) {
           
            #Check if the article already exist in local bd sqlite
            $article = DB::select('select id from trenzarticles where productId= '.$value['id']); 
            
            if(!$article) 
            {
                $article = $this->_trenzApiService->getArticle($value['id']);
             
                #Insert the articles id into trenzarticles table 
                $query = DB::insert('insert into trenzarticles (productId, price, stock, created_at)
                                        values (?, ?, ?)', [$value['id'], $article['data']['mainDetail']['prices'][0]['price'], $article['data']['mainDetail']['inStock']],date("Y-m-d H:i:s"));
            }  
    
        }
        
        return view("trenzarticles.trenz_dashboard");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Retrieve articles from Trenz using API,next compare with the entries of trenzarticle table
     * if for a retrieved article, there is no mapping with a entrie of the table, the we should create new entrie
     * if for a retrieved article, there is a mapping with the entries of the table, but at least one field value is different
     * we should run update.
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
