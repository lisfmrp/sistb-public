<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
include('Crypt/RSA.php');

$rsa = new Crypt_RSA();

$rsa->setHash('sha256');
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS8);

$privatekey = file_get_contents("keys/external_01_1.pkcs8");
$rsa->loadKey($privatekey);

$API_KEY = 'vrtXi2V202LXjkxLPHDNMVvKfNVYBBNSYsHsPpQKh8aDTyS5H2miF78NDK5nbibGKv5YL3Td9sVITGuHoOrnlGWnN9nNHY4WL797cUJiB7znngmKM9NROpOhagKM0FWK';

$signature = $rsa->sign($API_KEY);

echo base64_encode($signature);
echo "<br/><br/><br/>";

if($rsa->verify($API_KEY, base64_encode($signature))) {
	echo "Assinatura valida";
} else {
	echo "Assinatura invalida";
}
?>