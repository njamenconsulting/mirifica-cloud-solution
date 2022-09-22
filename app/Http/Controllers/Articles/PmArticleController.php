<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
#use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PmArticleController extends Controller
{
    public function index()
    {
        //
    }
    public function getReport()
    {
        //
    }
    public function updateOrCreateArticle()
    {

        $articles = DB::select('select * from trenzarticles'); 
        DB::update('update plentyarticles set price = 1210 where externalId =1873');
        DB::update('update plentyarticles set price = 1220 where externalId =1874');
        DB::update('update plentyarticles set price = 1240 where externalId =1876');
        $deleted = DB::delete('delete from plentyarticles where externalId =1882');
        $deleted = DB::delete('delete from plentyarticles where externalId =1884');
       
        foreach ($articles as $article) {
            
            $variation = DB::select('select * from plentyarticles where externalId = :id', ['id' => $article->productId]);
       
            if($variation)
            { 
                if($article->price != $variation[0]->price ){

                    $query = $this->update($article,$variation[0]->externalId);#   
                    if($query)  $report['updating'][$article->productId] = $article;
                }
            }
            else{

                $query = $this->add($article);
                if($query)  $report['adding'][$article->productId] = $article;
            }
   
        }

        return view('plentymarkets.index') ->with('variations', $report);
    }
    //    
    /**
     * add
     *
     * @param  mixed $data
     * @return boolean
     */
    public function add($data):bool
    {
        #Insert the particles id into trenzs table 
        $result = DB::insert('insert into plentyarticles (itemId, variationId, externalId, price, priceGross, stock)
                            values (?, ?, ?, ?, ?, ?)', 
                            ['NaN', 'NaN',$data->productId ,$data->price,round($data->price*1.19,2),$data->stock]
                        );
        return $result;
        
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
        $affected = DB::update('update plentyarticles set price = '.$data->price.' where externalId = ?',[$id]);

        return $affected;
    }

}
