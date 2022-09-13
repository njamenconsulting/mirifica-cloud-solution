<?php

namespace App\Helpers;

class ArrayToCsvHelper
{
    public static function createCsvFileFromArray($filename,$asso_array,$has_header,$separator)
    {
        $filename = date('Ymd-His').'-'.$filename.'.csv';

        $path = public_path('csv_files/'.$filename);
        # open in write only mode (write at the start of the file)
        $fp = fopen($path, 'w'); 
        
        # Loop over the array and passing in the values only.
        foreach ($asso_array as $key => $value) {
          //dd($asso_array,$key,$value);
            if(!$has_header)
            {
                #Add the keys as the column headers
                fputcsv($fp, array_keys($value)); 
                $has_header = true;
            }

            fputcsv($fp, $value);

        }  
        
        fclose($fp);     
  
    }
}