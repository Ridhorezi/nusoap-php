<?php
// Atur laporan kesalahan dan tampilkan pesan kesalahan
error_reporting(E_ALL);

ini_set('display_errors', 1);

// Include library NuSOAP
require_once('nusoap.php');

// Buat objek server SOAP
$server = new soap_server();

// Tentukan namespace yang akan digunakan
$namespace = 'http://localhost/nusoap-php'; 

// Konfigurasi WSDL
$server->configureWSDL('Penjumlahan', $namespace);

$server->wsdl->schemaTargetNamespace = $namespace;

// Fungsi untuk melakukan penjumlahan
function jumlahkan($x, $y) {
    return $x + $y;
}

// Fungsi untuk melakukan penjumlahan
function kurangkan($x, $y) {
    return $x - $y;
}

// Daftarkan operasi 'jumlahkan' dalam server
$server->register('jumlahkan', array('x' => 'xsd:int', 'y' => 'xsd:int'), array('return' => 'xsd:int'), $namespace);

// Daftarkan operasi 'jumlahkan' dalam server
$server->register('kurangkan', array('x' => 'xsd:int', 'y' => 'xsd:int'), array('return' => 'xsd:int'), $namespace);

// Menerima request dan memberikan respons
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';

$server->service(file_get_contents("php://input"));

exit();

?>
