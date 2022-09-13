<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Repositories\{PlentymarketRepository,TrenzRepository};

class TrenzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(public_path('csv_files/product_data.csv'), "r");

        $firstline = true;

        $faker = [2417,2420,1453,2422,2420,2310,3577,2330,2010,5010,1953,1926,1506];
        $i=0;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {
  
                $a=DB::table('trenzs')->insert([
                    'productId' => $faker[$i],
                    'price' => $data[1],
                    'stock' => $data[2],
                ]);
            }
            $i++; 
            $firstline = false;
        }

        fclose($csvFile);
    }
}
