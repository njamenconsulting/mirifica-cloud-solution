<?php
namespace App\Services\Curl;

class CurlService
{

    //This code has been taken from php.net dongchao769390531 at 163 dot com 

    /**
    * Curl send get request, support HTTPS protocol
    * @param string $url The request url
    * @param string $refer The request refer
    * @param int $timeout The timeout seconds
    * @return mixed
    */
    public function getRequest($url)
    {
        $certificate_location = public_path('certs/cacert.pem');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST=> $certificate_location,
            CURLOPT_SSL_VERIFYPEER=> $certificate_location,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));


        if(curl_exec($curl) === false) 
            return 'Erreur Curl : ' . curl_error($curl);
        else $result = curl_exec($curl);

        curl_close($curl);

        return $result;

    }

    /**
    * Curl send post request, support HTTPS protocol
    * @param string $url The request url
    * @param array $data The post data
    * @param string $refer The request refer
    * @param int $timeout The timeout seconds
    * @param array $header The other request header
    * @return mixed
    */
    public function postRequest($url, $fields, $header = [])
    {
        $certificate_location = public_path('certs/cacert.pem');

        //Initialize the cURL session
        $ch = curl_init($url);
        //if your request has headers like bearer token or defining JSON contents you have to set
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //If you want to include the header in the output set CURLOPT_HEADER to true
        curl_setopt($ch, CURLOPT_HEADER, false);
        //Set RETURNTRANSFER option to true to return the transfer as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        /*To check the existence of a common name in the SSL peer certificate can be set to
        0(to not check the names), 1(not supported in cURL 7.28.1), 2(default value and for production mode)*/
     
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
        //For posting fields as an array by cURL
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        //Execute cURL and return the string. depending on your resource this returns output like
        if(curl_exec($ch) === false) 
           return 'Erreur Curl : ' . curl_error($ch);
        else $result = curl_exec($ch);
      
        //Close cURL resource, and free up system resources
        curl_close($ch);

        return $result;

    }

}
