<?php

require PATH_LIB . '/Redbean/rb-sqlite.php';

function generateRandomString($length = 32) {
  return bin2hex(random_bytes($length / 2));
}

$path = PATH_DATA . '/db.sqlite3';

R::setup("sqlite:$path");

$messages = [
	[
		"encrypted_message" => "123",
		"to" => generateRandomString(),
    "signature" => generateRandomString(),
    "timestamp" => time(),
  ],
];

foreach ($messages as $key => $message) {
	$messageDb = R::dispense('message');
	$messageDb->encrypted_message = $message['encrypted_message'];
	$messageDb->to = $message['to'];
  $messageDb->from = $message['from'];
	$messageDb->timestamp = $message['timestamp'];
	$id = R::store($messageDb);
}

$messages = R::find('message', 'timestamp > ?', [time() - 108000000]);
