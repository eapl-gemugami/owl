<?php
$title = "Owl Messenger 🦉";

include_once PATH_APP . '/view/partials/base.php';
include_once PATH_APP . '/view/partials/header.php';
?>
<h1><a href="/">🦉 Owl Messenger</a></h1>
<h2>Your new address!</h2>

<p>IMPORTANT! Store both URLs now. If you refresh or go back, a new address will be generated.</p>
<p>If you lose your inbox URL you won't be able to read your messages.</p>
<hr>
<p>Share this URL to receive messages (PUBLIC):</p>
<p><a href='/send/<?= $publicKey ?>'>https://owl.eapl.me/send/<?= $publicKey ?></a>
<hr>
<p>Use the next URL to decrypt and read messages received in the address above.</p>
<p>Inbox URL (DON'T SHARE!):</p>
<p><a href='/inbox/<?= $privateKey ?>'>https://owl.eapl.me/owl/inbox/<?= $privateKey ?></a>
<hr>

<details>
  <summary><strong>Advanced</strong></summary>
  <p>This is your Address (Public Key):</p>
  <pre>
  <?= $publicKey ?>
  </pre>

  <p>This is your Secret Key (Private Key):</p>
  <pre>
  <?= $privateKey ?>
  </pre>

  <p>If you want to encrypt and sign messages offline or with a local tool, it's recommended to create a key pair from that tool.</p>
  <p>Only take care of using and address and a Secret Key looking similar to those shown in this page.</p>
</details>

<details>
	<summary><strong>How does it work?</strong></summary>
	<p>All messages are signed and decrypted using private keys.</p>
  <p>Encryption and sign verification is done with the public key (same than the address).</p>
  <p>Both keys use Base58 encoding</p>
  <p>
  <p>I don't store your private key, so if you lose it, I can't recover your messages</p>
  <p>It's received temporarily to show the page. It's not stored securely so some leaks could occur</p>
  <p>Consider this service as experimental.</p>
  <p>Don't use it for critical communication, since this is lacking a lot of security considerations implemented in many Instant Messengers or Secure mail software</p>
</details>
<?php
include_once PATH_APP . '/view/partials/footer.php';