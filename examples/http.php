<?php

include '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;

//var_dump(curl('http://192.168.16.181/logipoort/company/api/Monitor/info_count'));
//exit; 

$apiId = "1";
$apiKey = "82444824b84c183e9bfabb8daa95bc7d";
$httpheaders = [
    "Brin" => "ab",
    "apiId" => $apiId,
    "apiKey" => $apiKey
];
$config['headers'] = $httpheaders;
$config['timeout'] = 2.0;
$config['base_uri'] = 'http://192.168.16.181/logipoort/company/api/';


$client = new Client($config);

$value1 = "test22";
$value2 = "test222";

$options['form_params'] = [
    'foo' => 'bar',
    'baz' => ['hi', 'there!']
];

try {
    $res = $client->post('Monitor/info_count', $options);
    $code = $res->getStatusCode();
    $reason = $res->getBody()->getContents();
    var_dump($reason);
} catch (ClientException $ex) {
    var_dump($ex->getMessage());
}

function curl(string $url = "", array $params = [], string $apiId = "1", string $apiKey = "82444824b84c183e9bfabb8daa95bc7d") {
    if (empty($url) === true || filter_var($url, FILTER_VALIDATE_URL) === false) {
        return;
    }
    $httpheaders = array(
        "apiId:  $apiId",
        "apiKey: $apiKey"
    );
    $fields_string = http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0); //return url reponse header
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_TIMEOUT, 100020);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        return null;
    }
    curl_close($ch);
    if ($response === false || empty($response) === true) {
        return null;
    }
    return $response;
}
