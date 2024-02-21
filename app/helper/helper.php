<?php

use Illuminate\Support\Facades\Storage;

if( !function_exists( 'storeImage' ) ) {
    function storeImage($request, $key){
        if(is_numeric($key)){
            $image = $request[$key];
        }else{
            $image = $request->file($key);
        }

        $fileName = $image->hashName();
        $image->move(public_path('images/'), $fileName);

        return $fileName;
    }
}

if( !function_exists( 'getPrefix' ) ) {
    function getPrefix(){
        $url = url()->previous();
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $start = $protocol . '://' . $host;
        $lastSlashPos = strrpos($url, '/');

        if ($lastSlashPos !== false) {
            $dynamicPart = substr($url, strlen($start), $lastSlashPos - strlen($start));
            return $dynamicPart;
        }

        return false;
    }
}
