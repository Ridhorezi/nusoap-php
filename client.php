<?php
// Atur laporan kesalahan dan tampilkan pesan kesalahan
error_reporting(E_ALL);

ini_set('display_errors', 1);

// Include library NuSOAP
require_once('nusoap.php');

$client = new nusoap_client('http://localhost/nusoap-php/server.php?wsdl', 'wsdl');

$client->soap_defencoding = 'UTF-8';

$client->decode_utf8 = FALSE;

$error = $client->getError();
if ($error) {
    echo '<h2>Constructor error</h2><pre>' . $error . '</pre>';
}

// Data yang akan dikirimkan ke server
$bil1 = 10;
$bil2 = 25;

// Panggil operasi 'jumlahkan' pada server
$result = $client->call('jumlahkan', array('x' => $bil1, 'y' => $bil2));


if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    $error = $client->getError();
    if ($error) {
        echo '<h2>Error</h2><pre>' . $error . '</pre>';
    } else {
        echo '<h2>Result</h2><pre>';
        echo "Hasil penjumlahan ".$bil1." dan ".$bil2." adalah ".$result;
        echo '</pre>';
    }
}

echo '<h2>Request</h2>';

echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';

echo '<h2>Respond</h2>';

echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
?>
