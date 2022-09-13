<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Plentymarket;
use App\Repositories\{PlentymarketRepository,TrenzRepository};


class PlentymarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $csvFile = fopen(public_path('csv_files/variations_data.csv'), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            

            if (!$firstline) {
                $data[2] = (new PlentymarketRepository) -> getExternalId($data[0],$data[1]);

                $a=DB::table('plentymarkets')->insert([
                    'itemId' => $data[0],
                    'variationId' => $data[1],
                    'externalId' => $data[2],
                    'price' => $data[3],
                    'priceGross' => $data[3],
                    'stock' => $data[4],
                ]);
            }

            $firstline = false;
        }

        fclose($csvFile);
       
                        /*
                Plentymarket::create([
                    'itemId' => $data['1'],
                    'variationId' => $data['2'],
                    'externalId' => $data['3'],
                    'priceGross' => $data['4'],
                    'stock' => $data['5'],
                ]);
                 */
      
    }
}
