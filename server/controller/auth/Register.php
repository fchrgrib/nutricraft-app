
<?php 

use data\Users;

require_once('../../handler/data/Users.php');
require_once('../../db/Database.php');

$data = json_decode(file_get_contents("php://input"),true);
$user = new Users();

if(isset($data['email'])){
    if($user->isEmailExists($data['email'])){
        echo json_encode(array('status'=>'ERROR','message' => 'Email sudah terdaftar'));
    }else{
        echo json_encode(array('status'=>'OK','message' => 'Email tersedia'));
    }
}

if(isset($data['phoneNumber'])){
    if($user->isPhoneNumberExists($data['phoneNumber'])){
        echo json_encode(array('status'=>'ERROR','message' => 'Nomer telepon sudah terdaftar'));
    }else{
        echo json_encode(array('status'=>'OK','message' => 'Nomor telepon tersedia'));
    }
}


if (isset($_POST['uname']) && isset($_POST['psw']) && isset($_POST['email']) && isset($_POST['phoneNumber'])) {
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $user->Insert($username, $email, $phoneNumber, $password, "user");
    $id = $user->FindIdByEmail($email);
    addCoins($id);
    if(is_dir("../../../assets/user/$id" == false)){
        echo "<script>('create folder')</script>";
        mkdir("../../../assets/user/$id",0777,true);    
    }
    echo "<script>alert('registrasi berhasil')</script>";
    echo "<script>location.href='/?home'</script>";
}

      
function addCoins($id){
    $serviceUrl =  $_ENV['SOAP_URL_USER_LEVEL']."?APIkey=".$_ENV["SOAP_KEY"];
   
    $soapRequest = '
    <Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
        <Body>
            <newUser xmlns="http://Services.nutricraft.org/">
                <arg0 xmlns="">'.$id.'</arg0>
            </newUser>
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
        $xml = new SimpleXMLElement($response);
        $returnValue = (string)$xml->xpath('//return')[0];
        echo $returnValue;
    }
}

?>