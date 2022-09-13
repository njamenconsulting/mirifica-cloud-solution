<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TrenzRepository;
use App\Helpers\{MepaDatatrenzHelper,ArrayToCsvConverterHelper};
use Illuminate\Support\Facades\DB;

class TrenzController extends Controller
{
    //
    private $_trenzRepository;
    
    function __construct()
    {
        $this->_trenzRepository = new TrenzRepository();
    }
    public function index(){
        return view('trenz.trenz_index');
    }  
    public function addArticles(){
 
        $articles = $this->_trenzRepository->getAllArticle();
   
        if($articles['success'])
        {
            foreach ($articles['data'] as $key => $value) {
                #Check if the article already exist in local bd sqlite
                $article = DB::select('select id from trenzs where productId= '.$value['id']); 
             
                if(!$article) 
                {
                    $articleDetail = $this->_trenzRepository->getArticle($value['id']);
                    
                    #Insert the particles id into trenzs table 
                    $query = DB::insert('insert into trenzs (productId, price, stock)
                                         values (?, ?, ?)', [$value['id'], $articleDetail['data']['mainDetail']['prices'][0]['price'], $articleDetail['data']['mainDetail']['inStock']]);
                }
            }
            dd($article,$query);
        }
        
        return view('trenz.trenz_index');
    }  
    public function getAllArticles(){
        $responseJson = $this->_trenzRepository->getArticle();
    }
}
