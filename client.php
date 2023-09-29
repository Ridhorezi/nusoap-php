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
    echo '<h3>Constructor error</h3><pre>' . $error . '</pre>';
}

// Data yang akan dikirimkan ke server
$bil1 = 10;
$bil2 = 25;

// Panggil operasi 'jumlahkan' pada server
$resultTambah = $client->call('jumlahkan', array('x' => $bil1, 'y' => $bil2));

// Panggil operasi 'kurangkan' pada server
$resultKurang = $client->call('kurangkan', array('x' => $bil1, 'y' => $bil2));

if ($client->fault) {
    echo '<h3>Fault</h3><pre>';
    print_r($resultTambah);
    echo '</pre>';
} else {
    $error = $client->getError();
    if ($error) {
        echo '<h3>Error</h3><pre>' . $error . '</pre>';
    } else {
        echo '<h3>Result Penjumlahan</h3><pre>';
        echo "Hasil penjumlahan " . $bil1 . " dan " . $bil2 . " adalah " . $resultTambah;
        echo '</pre>';

        echo '<h3>Result Pengurangan</h3><pre>';
        echo "Hasil pengurangan " . $bil1 . " dan " . $bil2 . " adalah " . $resultKurang;
        echo '</pre>';
    }
}

// Lakukan panggilan metode "jumlahkan"
$resultTambah = $client->call('jumlahkan', array('x' => $bil1, 'y' => $bil2));

echo '<h3>Request Jumlahkan</h3>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h3>Respond Jumlahkan</h3>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';

// Lakukan panggilan metode "jumlahkan"
$resultKurang = $client->call('kurangkan', array('x' => $bil1, 'y' => $bil2));

echo '<h3>Request Kurangkan</h3>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h3>Respond Kurangkan</h3>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
?>
