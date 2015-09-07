<?

$url = 'http://kupite-mne.ru/myaccount/';

$content = json_encode( array('cmd'=>'Category')) ;

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HEADER, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));

curl_setopt($curl, CURLOPT_POST, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$json_response = curl_exec($curl);

$obj = $content;

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if( $status == 200 ) {

    echo $json_response;
} else {
    echo $status;
}
?>