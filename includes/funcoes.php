<?php 
session_start();

function getData($url, $token){

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "$url",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: bearer '.$token,
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($status_code == 401){
        session_destroy();
         header('Location: /login.php');
        exit;
    } 
    $err = curl_error($curl);
    
    $response = json_decode($response, true);
    curl_close($curl);
    return $response;
}

function postData($url, $token, $dados){

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $dados,
        CURLOPT_HTTPHEADER => array(
            "Authorization: bearer $token",
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    
    $err = curl_error($curl);

    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($status_code == 401){
        session_destroy();
         header('Location: /login.php');
        exit;
    }    
    curl_close($curl);
    
    $response = json_decode($response, true); 


    return $response;
}

function putData($url, $token, $dados){

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $dados,
        CURLOPT_HTTPHEADER => array(
            "Authorization: bearer $token",
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    
    $err = curl_error($curl);

    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($status_code == 401){
        session_destroy();
         header('Location: /login.php');
        exit;
    }    
    curl_close($curl);
    
    $response = json_decode($response, true); 


    return $response;
}

