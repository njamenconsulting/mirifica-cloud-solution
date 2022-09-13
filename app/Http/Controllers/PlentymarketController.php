<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Plentymarket\{PlentymarketUpdatingService,PlentymarketCheckingUpdateService};
use App\Helpers\{CsvToArrayHelper,ArrayToCsvHelper};
use Illuminate\Support\Facades\Http;
use App\Repositories\{PlentymarketRepository,TrenzRepository};
use Illuminate\Support\Facades\DB;

class PlentymarketController extends Controller
{
    private $_plentymarketRepository;
    private $_trenzRepository;
    private $_plentymarketCheckingUpdateService;
   
    function __construct()
    {
        $this->_plentymarketRepository = new PlentymarketRepository();
        $this->_trenzRepository = new TrenzRepository();
        $this->_pmUpdatingService = new PlentymarketUpdatingService();
        $this->_pmCheckingUpdateService = new plentymarketCheckingUpdateService();
        
    } 

    public function index(){
        $articles = DB::select('select * from trenzs');
       
        for ($i=0; $i  < count($articles) ; $i++) { 
            
            #Insert the particles id into trenzs table 
            $query = DB::insert('insert into plentymarkets (itemId, variationId, externalId, price, priceGross, stock)
            values (?, ?, ?, ?, ?, ?)', ['NaN', 'NaN',$articles[$i]->productId ,'NaN','NaN','NaN']);
        } 
dd($query);
        return view('plentymarkets.index');
    }

    public function updateDb()
    {
        #
        $variationsToUpdate = $this->_pmCheckingUpdateService->checkPrice();
        //$variationsStock = $this->_pmCheckingUpdateService->checkStock();
        #
        $this->_pmUpdatingService->updatePrice($variationsToUpdate);
        //$reportData= $this->_pmUpdatingService->updateStock($variationsStock);
        # Put updating data into csv file for report and log
        ArrayToCsvHelper::createCsvFileFromArray("updating-price-report",$variationsToUpdate,false,",");
        //ArrayToCsvHelper::createCsvFileFromArray("updating-stock-report",$variationsStock ,false,",");
//dd($variationsToUpdate);
        //return redirect('dashboard')->with('data', $reportData);
        return view('plentymarkets.index') ->with('variations', $variationsToUpdate);

    }
    public function updateApi()
    {

    }
}
