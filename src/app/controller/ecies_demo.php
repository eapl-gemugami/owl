<?php
# Hide deprecated
#error_reporting(E_ERROR | E_WARNING | E_PARSE);

require PATH_VENDOR . '/autoload.php';
require 'ecies.php';
use Elliptic\EC;
$base58 = new StephenHill\Base58();

echo '<pre>';

$ec = new EC('secp256k1');

// Generate keys
$key1Priv = $ec->genKeyPair();
$key2Priv = $ec->genKeyPair();

// Load keys from a str
$private1 = 'G5udmJxKDSLKZxKz5WGnq5HwDvDfzf8NrsH2pexVeKPD';
$public1 = '29tfL5jemC7ZgtBkmqEdZNF2Dyib9hyMvDJBg92DBne3e';

$private2 = 'cciciP9ounQWbvcDDwC64Tsa7LRTF2uX7pYPY9NZiU2';
$public2 = 'saCdut5y8ESyZiFN3v1WyepUcSA2mc4oMiDkNB7vfB2h';

#echo $base58->decode($private1);

try {
	$key1Priv = $ec->keyFromPrivate(bin2hex($base58->decode($private1)), 16);
	$key2Priv = $ec->keyFromPrivate(bin2hex($base58->decode($private2)), 16);
} catch (InvalidArgumentException $iae) {
	echo 'Invalid key';
	die();
}

// Get public parts from generated keys
$key1Pub = $ec->keyFromPublic($key1Priv->getPublic());
$key2Pub = $ec->keyFromPublic($key2Priv->getPublic());

/*
echo "Key1 Priv\n";
echo $base58->encode(hex2bin($key1Priv->getPrivate("hex")));
echo "\n";

echo "Key1 Pub\n";
echo $base58->encode(hex2bin($key1Priv->getPublic(true, "hex")));
echo "\n\n";

echo "Key2 Priv\n";
echo $base58->encode(hex2bin($key2Priv->getPrivate("hex")));
echo "\n";

echo "Key2 Pub\n";
echo $base58->encode(hex2bin($key2Priv->getPublic(true, "hex")));
echo "\n";
*/

$textToEncrypt = "ADDRESS|😁 カタカナ|SIGNATURE";

// Encrypt using private from key1 and public from key2
$ecies1 = new ECIES($key1Priv, $key2Pub);
$cipher = $ecies1->encrypt($textToEncrypt);

// Decrypt using private from key2 and public from key1
$ecies1 = new ECIES($key2Priv, $key1Pub);
$decryptedText = $ecies1->decrypt($cipher);

echo "\nSource text: " . $textToEncrypt . "\n";
echo "Cipher: " . $base58->encode($cipher) . "\n";
echo "Decrypted: " . $decryptedText . "\n";

// Sign encrypted message
// https://crypto.stackexchange.com/a/60390
$signature = $base58->encode(hex2bin($key1Priv->sign(bin2hex($cipher))->toDER('hex')));

echo "Signature: " . $signature . "\n";