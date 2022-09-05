<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TrenzRepository;
use App\Helpers\{MepaDatatrenzHelper,ArrayToCsvConverterHelper};

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
    public function getAllArticles(){
        $responseJson = $this->_trenzRepository->getArticle();
    }
}
