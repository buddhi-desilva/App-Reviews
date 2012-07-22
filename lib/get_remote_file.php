<?php 
function kill3rMedia_get_remote_file($url) { 
    if (ini_get('allow_url_fopen')) { 
        return @file_get_contents($url); 
    } 
    elseif (function_exists('curl_init')) { 
        $c = curl_init($url); 
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($c, CURLOPT_HEADER, 0); 
        $file = curl_exec($c); 
        curl_close($c); 
        return $file; 
    } 
    else { 
        die('Could not access file from remoteserver!'); 
    } 
} 
?>