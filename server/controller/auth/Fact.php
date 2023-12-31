<?php
$API = $_ENV['USER_KEY'];
$userCookie = $_COOKIE['user'];
$userData = json_decode($userCookie);
$idUser = $userData[0]->id;

// u
///////////////////////////
if(isset($_GET['select'])){
    $select = $_GET['select'];
    $search = $_GET['search'];
    if($search!=""){
        if($select=="Subscribed"){
            $uuid = getUUID($idUser);
            $post_data = json_encode(array(
                'subscribes' => $uuid,
                'title' => $search,
            ));

            $content = curl_init("http://nutricraft-express:8080/content/title/subscriber");
            curl_setopt($content, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($content, CURLOPT_POST, true);
            curl_setopt($content, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($content, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
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
            
            $path_photo = array();
            $creatorArr = array();
            
            for($i = 0; $i < count($idPhotoArray); $i++) {
                $idPhoto = $idPhotoArray[$i];
                $photo = curl_init();
                curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?APIkey=$API");
                curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($photo);
                if (curl_errno($photo)) {
                    echo 'Curl error: ' . curl_error($photo);
                }
                curl_close($photo);
                $tempResponse = json_decode($tempResponse, true);
                $url = $tempResponse['data']['url'];
            
                $path_photo[$i] = $url;
            }
            for($i = 0; $i < count($idCreatorArray); $i++) {
                $idCreator = $idCreatorArray[$i];
                $creator = curl_init();
                curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
                curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($creator);
                if (curl_errno($creator)) {
                    echo 'Curl error: ' . curl_error($creator);
                }
                curl_close($creator);
                $tempResponse = json_decode($tempResponse, true);
                $name = $tempResponse['data']['name'];
                $creatorArr[$i] = $name;
            }
            
            for($i = 0; $i < count($data['data']); $i++) {
                $data['data'][$i]['path_photo'] = $path_photo[$i];
                $data['data'][$i]['author'] = $creatorArr[$i];
            }
            
            if ($data) {
                echo json_encode($data);
            } else {
                echo 'API request failed';
            }
        }else{
            if($select=="All"){
                $post_data = json_encode(array(
                    'title' => $search,
                ));
                $content = curl_init("http://nutricraft-express:8080/content/title/?APIkey=$API");
                curl_setopt($content, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($content, CURLOPT_POST, true);
                curl_setopt($content, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($content, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                ));
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
                
                $path_photo = array();
                $creatorArr = array();
                
                for($i = 0; $i < count($idPhotoArray); $i++) {
                    $idPhoto = $idPhotoArray[$i];
                    $photo = curl_init();
                    curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?APIkey=$API");
                    curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
                    $tempResponse = curl_exec($photo);
                    if (curl_errno($photo)) {
                        echo 'Curl error: ' . curl_error($photo);
                    }
                    curl_close($photo);
                    $tempResponse = json_decode($tempResponse, true);
                    $url = $tempResponse['data']['url'];
                
                    $path_photo[$i] = $url;
                }
                for($i = 0; $i < count($idCreatorArray); $i++) {
                    $idCreator = $idCreatorArray[$i];
                    $creator = curl_init();
                    curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
                    curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
                    $tempResponse = curl_exec($creator);
                    if (curl_errno($creator)) {
                        echo 'Curl error: ' . curl_error($creator);
                    }
                    curl_close($creator);
                    $tempResponse = json_decode($tempResponse, true);
                    $name = $tempResponse['data']['name'];
                    $creatorArr[$i] = $name;
                }
                
                for($i = 0; $i < count($data['data']); $i++) {
                    $data['data'][$i]['path_photo'] = $path_photo[$i];
                    $data['data'][$i]['author'] = $creatorArr[$i];
                }
                
                if ($data) {
                    echo json_encode($data);
                } else {
                    echo 'API request failed';
                }
            }
        }
    }else{
        if($select=="Subscribed"){
            $uuid = getUUID($idUser);
            $post_data = json_encode(array(
                'subscribes' => $uuid
            ));

            $content = curl_init("http://nutricraft-express:8080/content/subscriber");
            curl_setopt($content, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($content, CURLOPT_POST, true);
            curl_setopt($content, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($content, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
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
            
            $path_photo = array();
            $creatorArr = array();
            
            for($i = 0; $i < count($idPhotoArray); $i++) {
                $idPhoto = $idPhotoArray[$i];
                $photo = curl_init();
                curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?APIkey=$API");
                curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($photo);
                if (curl_errno($photo)) {
                    echo 'Curl error: ' . curl_error($photo);
                }
                curl_close($photo);
                $tempResponse = json_decode($tempResponse, true);
                $url = $tempResponse['data']['url'];
            
                $path_photo[$i] = $url;
            }
            for($i = 0; $i < count($idCreatorArray); $i++) {
                $idCreator = $idCreatorArray[$i];
                $creator = curl_init();
                curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
                curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($creator);
                if (curl_errno($creator)) {
                    echo 'Curl error: ' . curl_error($creator);
                }
                curl_close($creator);
                $tempResponse = json_decode($tempResponse, true);
                $name = $tempResponse['data']['name'];
                $creatorArr[$i] = $name;
            }
            
            for($i = 0; $i < count($data['data']); $i++) {
                $data['data'][$i]['path_photo'] = $path_photo[$i];
                $data['data'][$i]['author'] = $creatorArr[$i];
            }
            
            if ($data) {
                echo json_encode($data);
            } else {
                echo 'API request failed';
            }
        }else{
            $content = curl_init();
            curl_setopt($content, CURLOPT_URL, "http://nutricraft-express:8080/content?APIkey=$API");
            curl_setopt($content, CURLOPT_RETURNTRANSFER, 1);
            
            $response = curl_exec($content);
            
            if (curl_errno($content)) {
                echo 'Curl error: ' . curl_error($content);
            }
            
            curl_close($content);
            
            $data = json_decode($response, true);
            // echo $data;
            
            $idPhotoArray = array_map(function($item) {
                return $item['id_photo'];
            }, $data['data']);

            $idCreatorArray = array_map(function($item) {
                return $item['id_creator'];
            }, $data['data']);
            
            $path_photo = array();
            $creatorArr = array();
            
            for($i = 0; $i < count($idPhotoArray); $i++) {
                $idPhoto = $idPhotoArray[$i];
                $photo = curl_init();
                curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?APIkey=$API");
                curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($photo);
                if (curl_errno($photo)) {
                    echo 'Curl error: ' . curl_error($photo);
                }
                curl_close($photo);
                $tempResponse = json_decode($tempResponse, true);
                $url = $tempResponse['data']['url'];
            
                $path_photo[$i] = $url;
            }
            for($i = 0; $i < count($idCreatorArray); $i++) {
                $idCreator = $idCreatorArray[$i];
                $creator = curl_init();
                curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
                curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
                $tempResponse = curl_exec($creator);
                if (curl_errno($creator)) {
                    echo 'Curl error: ' . curl_error($creator);
                }
                curl_close($creator);
                $tempResponse = json_decode($tempResponse, true);
                $name = $tempResponse['data']['name'];
                $creatorArr[$i] = $name;
            }
            
            for($i = 0; $i < count($data['data']); $i++) {
                $data['data'][$i]['path_photo'] = $path_photo[$i];
                $data['data'][$i]['author'] = $creatorArr[$i];
            }
            
            if ($data) {
                echo json_encode($data);
            } else {
                echo 'API request failed';
            }
        }

    
    }
}

if(isset($_GET['show'])){
    $content = curl_init();
    curl_setopt($content, CURLOPT_URL, "http://nutricraft-express:8080/content?APIkey=$API");
    curl_setopt($content, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec($content);
    
    if (curl_errno($content)) {
        echo 'Curl error: ' . curl_error($content);
    }
    
    curl_close($content);
    
    $data = json_decode($response, true);
    // echo $data;
    
    $idPhotoArray = array_map(function($item) {
        return $item['id_photo'];
    }, $data['data']);

    $idCreatorArray = array_map(function($item) {
        return $item['id_creator'];
    }, $data['data']);
    
    $path_photo = array();
    $creatorArr = array();
    
    for($i = 0; $i < count($idPhotoArray); $i++) {
        $idPhoto = $idPhotoArray[$i];
        $photo = curl_init();
        curl_setopt($photo, CURLOPT_URL, "http://nutricraft-express:8080/image/$idPhoto?APIkey=$API");
        curl_setopt($photo, CURLOPT_RETURNTRANSFER, 1);
        $tempResponse = curl_exec($photo);
        if (curl_errno($photo)) {
            echo 'Curl error: ' . curl_error($photo);
        }
        curl_close($photo);
        $tempResponse = json_decode($tempResponse, true);
        $url = $tempResponse['data']['url'];
    
        $path_photo[$i] = $url;
    }
    for($i = 0; $i < count($idCreatorArray); $i++) {
        $idCreator = $idCreatorArray[$i];
        $creator = curl_init();
        curl_setopt($creator, CURLOPT_URL, "http://nutricraft-express:8080/user/$idCreator?APIkey=$API");
        curl_setopt($creator, CURLOPT_RETURNTRANSFER, 1);
        $tempResponse = curl_exec($creator);
        if (curl_errno($creator)) {
            echo 'Curl error: ' . curl_error($creator);
        }
        curl_close($creator);
        $tempResponse = json_decode($tempResponse, true);
        $name = $tempResponse['data']['name'];
        $creatorArr[$i] = $name;
    }
    
    for($i = 0; $i < count($data['data']); $i++) {
        $data['data'][$i]['path_photo'] = $path_photo[$i];
        $data['data'][$i]['author'] = $creatorArr[$i];
    }
    
    if ($data) {
        echo json_encode($data);
    } else {
        echo 'API request failed';
    }
}

function getUUID($idSubs) {
    $serviceUrl =  $_ENV['SOAP_URL_SUBSCRIBE']."?APIkey=".$_ENV["SOAP_KEY"];
   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        <Body>
            <getCreators xmlns="http://Services.nutricraft.org/">
                <arg0 xmlns="">'.$idSubs.'</arg0>
            </getCreators>
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
