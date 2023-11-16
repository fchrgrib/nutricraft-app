<?php

$API = $_ENV['USER_KEY'];
$userCookie = $_COOKIE['user'];
$userData = json_decode($userCookie);
$idUser = $userData[0]->id;

if(isset($_GET['subscribe'])){
    $subs  = $_GET['subscribe'];
    if($subs == "1"){
        $result = subscribe();
        echo json_encode($result);
    }else{
        $result = unSubscribe();
        echo json_encode($result);
    }
}else{
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $content = curl_init();
        curl_setopt($content, CURLOPT_URL, "http://nutricraft-express:8080/content/$id?API_KEY=$API");
        curl_setopt($content, CURLOPT_RETURNTRANSFER, 1);
        
        $response = curl_exec($content);
        
        if (curl_errno($content)) {
            echo 'Curl error: ' . curl_error($content);
        }
        
        curl_close($content);
        
        $data = json_decode($response, true);
    
        $idPhotoArray = array_map(function($item) {
            return $item['id_photo'];
        }, $data['data']);
    
        $idCreatorArray = array_map(function($item) {
            return $item['id_creator'];
        }, $data['data']);
        
    
        //////GET URL PHOTO//////
        $idPhoto = $idPhotoArray[0];
        $photo = curl_init();
        curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?API_KEY=$API");
        curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
        $photoResponse = curl_exec($photo);
        if (curl_errno($photo)) {
            echo 'Curl error: ' . curl_error($photo);
        }
        curl_close($photo);
        $photoResponse = json_decode($photoResponse, true);
        $url = $photoResponse['data']['url'];
        $path_photo = $url;
    
        //////GET AUTHOR//////
        $idCreator = $idCreatorArray[0];
        $creator = curl_init();
        curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
        curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
        $creatorResponse = curl_exec($creator);
        if (curl_errno($creator)) {
            echo 'Curl error: ' . curl_error($creator);
        }
        curl_close($creator);
        $creatorResponse = json_decode($creatorResponse, true);
        $author = $creatorResponse['data']['name'];
        $uuid = $creatorResponse['data']['uuid'];
        
    
        //ADD URL PHOTO,AUTHOR,&TOTAL SUBS TO DATA
        $data['data'][0]['path_photo'] = $path_photo;
        $data['data'][0]['author'] = $author;
        $data['data'][0]['total_subscriber'] = count((getSubs($uuid)));
        $data['data'][0]['is_subscribe'] = isSubscribe($uuid, $idUser);
        $data['data'][0]['uuid'] = $uuid;
        
        
        if ($data) {
            addExp($idUser);
            echo json_encode($data);
        } else {
            echo 'API request failed';
        }
    
    }
}



function getSubs($uuid){
    $serviceUrl =  $_ENV['SOAP_URL_SUBSCRIBE']."?APIkey=".$_ENV["SOAP_KEY"];
   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <getSubscribers xmlns="http://Services.nutricraft.org/">
            <arg0 xmlns="">'.$uuid.'</arg0>
        </getSubscribers>
    </Body>
</Envelope>';

    $options = [
        CURLOPT_URL            => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $soapRequest,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapRequest),
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    curl_close($curl);

    if (curl_errno($curl)) {
        echo 'cURL Error: ' . curl_error($curl);
    } else {
        $xml = simplexml_load_string($response);
        $ret = array();
        foreach ($xml->xpath('//return') as $value) {
            $ret[] = (string)$value;
        }
        return $ret;
    }
}


function isSubscribe($creator, $subscriber){
    $serviceUrl =  $_ENV['SOAP_URL_SUBSCRIBE']."?APIkey=".$_ENV["SOAP_KEY"];
   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        <Body>
            <checkSubscription xmlns="http://Services.nutricraft.org/">
                <arg0 xmlns="">'.$creator.'</arg0>
                <arg1 xmlns="">'.$subscriber.'</arg1>
            </checkSubscription>
        </Body>
    </Envelope>';

    $options = [
        CURLOPT_URL            => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $soapRequest,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapRequest),
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    curl_close($curl);

    if (curl_errno($curl)) {
        echo 'cURL Error: ' . curl_error($curl);
    } else {
        $xml = simplexml_load_string($response);
        return $xml->xpath('//return')[0];
    }
}


function subscribe(){
    $serviceUrl =  $_ENV['SOAP_URL_SUBSCRIBE']."?APIkey=".$_ENV["SOAP_KEY"];
    $uuid = $_GET['uuid'];
    $id = $_GET['id'];
   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <newSubscription xmlns="http://Services.nutricraft.org/">
            <arg0 xmlns="">'.$uuid.'</arg0>
            <arg1 xmlns="">'.$id.'</arg1>
        </newSubscription>
    </Body>
</Envelope>';

    $options = [
        CURLOPT_URL            => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $soapRequest,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapRequest),
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    curl_close($curl);

    if (curl_errno($curl)) {
        echo 'cURL Error: ' . curl_error($curl);
    } else {
        $xml = simplexml_load_string($response);
        return $xml->xpath('//return')[0];
    }
}
function unSubscribe(){
    $serviceUrl =  $_ENV['SOAP_URL_SUBSCRIBE']."?APIkey=".$_ENV["SOAP_KEY"];
    $uuid = $_GET['uuid'];
    $id = $_GET['id'];

   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        <Body>
            <unsubscribe xmlns="http://Services.nutricraft.org/">
                <arg0 xmlns="">'.$uuid.'</arg0>
                <arg1 xmlns="">'.$id.'</arg1>
            </unsubscribe>
        </Body>
    </Envelope>';

    $options = [
        CURLOPT_URL            => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $soapRequest,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapRequest),
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    curl_close($curl);

    if (curl_errno($curl)) {
        echo 'cURL Error: ' . curl_error($curl);
    } else {
        $xml = simplexml_load_string($response);
        return $xml->xpath('//return')[0];
    }
}


function addExp($id){
    $serviceUrl =  $_ENV['SOAP_URL_USER_LEVEL']."?APIkey=".$_ENV["SOAP_KEY"];

    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        <Body>
            <addExpUser xmlns="http://Services.nutricraft.org/">
                <arg0 xmlns="">'.$id.'</arg0>
                <arg1 xmlns="">10</arg1>
            </addExpUser>
        </Body>
    </Envelope>';

    $options = [
        CURLOPT_URL            => $serviceUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $soapRequest,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($soapRequest),
        ],
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);

    curl_close($curl);

    if (curl_errno($curl)) {
        echo 'cURL Error: ' . curl_error($curl);
    } else {
        $xml = simplexml_load_string($response);
        return $xml->xpath('//return')[0];
    }
}