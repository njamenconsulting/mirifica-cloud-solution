<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Trenz\TrenzApiArticleRepository;
use App\Repositories\Sqlite\TrenzRepository;
use Illuminate\Support\Facades\DB;

class TrenzArticleController extends Controller
{
    public $_trenzApiArticleRepository;
    private $_trenzRepository;

    function __construct(TrenzApiArticleRepository $trenzArticle,TrenzRepository $trenzRepository)
    {
        $this -> _trenzApiArticleRepository = $trenzArticle;
        $this -> _trenzRepository = $trenzRepository;
    }
    //
    public function index()
    {
        echo "report trenz process";
    }
    /**
     * Retrieving articles from Trenz API 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        $articles1 = $this -> _trenzApiArticleRepository->getAllArticle(0);

        if($articles1['success'])
        {
                    
          if( $articles1['total'] != count($articles1['data'])) 
          {
            $offset =  count($articles1['data'])+1;

            $articles2 = $this -> _trenzApiArticleRepository->getAllArticle($offset);

            if($articles2['success']){

                $articles['data'] =array_merge($articles1['data'],$articles2['data']);

                $this-> store($articles);
            }   
          }
          else          
            $this-> store($articles);
        }

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
        foreach ($articles['data'] as $key => $value) {
           
            #Check if the article already exist in local bd sqlite
            $article = DB::select('select id from trenzarticles where productId= '.$value['id']); 
            
            if(!$article) 
            {
                $article = $this->_trenzApiArticleRepository->getArticle($value['id']);
             
                #Insert the articles id into trenzarticles table 
                $query = DB::insert('insert into trenzarticles (productId, price, stock)
                                        values (?, ?, ?)', [$value['id'], $article['data']['mainDetail']['prices'][0]['price'], $article['data']['mainDetail']['inStock']]);
            }
        
    
        }
        
        return view('trenz.trenz_index');
    }
    public function update()
    {
        //
    }
}
