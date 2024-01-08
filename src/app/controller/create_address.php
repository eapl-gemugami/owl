<?php
require PATH_VENDOR . '/autoload.php';
require 'ecies.php';
use Elliptic\EC;


function createKeyPair() {
  $base58 = new StephenHill\Base58();
  $ec = new EC('secp256k1');

  // Generate key pair
  $key1Priv = $ec->genKeyPair();

  // Get public parts from generated keys
  $key1Pub = $ec->keyFromPublic($key1Priv->getPublic());

  $privateKey = 'SECRET-' . $base58->encode(hex2bin($key1Priv->getPrivate("hex")));
  $publicKey = 'A-' . $base58->encode(hex2bin($key1Priv->getPublic(true, "hex")));
  return ['privateKey' => $privateKey, 'publicKey' => $publicKey];
}

