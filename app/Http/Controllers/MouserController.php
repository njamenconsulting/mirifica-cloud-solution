<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MouserRepository;
use App\Helpers\JsonToCsvHelper;
use App\Helpers\{ArrayToCsvConverterHelper,MepaMouserDataHelper};

class MouserController extends Controller
{    
    /**
     * _mouserRepository
     *
     * @var MouserRepository
     */
    private $_mouserRepository;
   
    function __construct()
    {
        $this->_mouserRepository = new MouserRepository();
    }   
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view('mousers.mouser_index');
    }
    public function getFormKeywordSearch()
    {
        return view('mousers.form_keywordsearch');
    }
    //
    public function postFormKeywordSearch(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|max:255',
            'records' => 'required|integer',
            'startingRecord' => 'required|integer',
            'searchOptions' => 'required|string',
            'version' => 'required|string',
        ]);
        
        $jsonData = $this->_mouserRepository->getPartsByKeyword($validated);
        $arraydata = json_decode($jsonData,true);

        $NumberOfResult = $arraydata['SearchResults']['NumberOfResult'];
        $nbOfRequest = $NumberOfResult/50;
       
        $result=[];
        $result[0] = $arraydata['SearchResults']['Parts'];

        for ($i=1; $i < 10; $i++) { 
  
            $jsonData = $this->_mouserRepository->getPartsByKeyword($validated);
            $arraydata = json_decode($jsonData,true);

            $result[$i] = $arraydata['SearchResults']['Parts'];
            $result[0] = array_merge($result[0], $result[$i] );
            $validated['startingRecord'] = $validated['startingRecord'] + 50 ;
        }

        $data=MepaMouserDataHelper::extractedDataForMepa($result[0]);

        $csv = ArrayToCsvConverterHelper::arrayToCsvConverter($data);

        return response($csv)
                    ->withHeaders([
                        'Content-Type' => 'application/csv',
                        'Content-Disposition' => 'attachment; filename='.date('Ymd_His').'-mouser-'.$validated["keyword"].'.csv',
                        'Content-Transfer-Encoding' => 'UTF-8',
                    ]);   
        //return view('mousers.mouser_index',$data);      
    }

    public function manufacturerList()
    {
        $response = $this->_mouserRepository->getmanufacturerlist();
        echo $response;
    }
}
