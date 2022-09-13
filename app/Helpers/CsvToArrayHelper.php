<?php

namespace App\Helpers;

class CsvToArrayHelper
{
    public static function assosiactiveArrayFromCsvFile($filename)
    {
        $assoc_array = [];
    
        if (($handle = fopen($filename, "r")) !== false) {                 // open for reading
            if (($data = fgetcsv($handle, 1000, ",")) !== false) {         // extract header data
                $keys = $data;                                             // save as keys
            }
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {      // loop remaining rows of data
                if(count($keys) == count($data)){
                  $assoc_array[] = array_combine($keys, $data);              // push associative subarrays
                } else{
                  dd($keys, $data); 
                    echo "The arrays have unequal length \n";
                }
            }
            fclose($handle);                                               // close when done
        }
        return $assoc_array;
    }
    
}