<?php
# Hide deprecated
error_reporting(E_ERROR | E_WARNING | E_PARSE);
# TODO: Fix this to the right reporting based on environment

# Load Straight Framework
require PATH_LIB . '/Straight/straight.php';

# English by default
require PATH_I18N . '/i18n.php';

# Load the dict with configuration
require PATH_PRIVATE . '/config.php';

# URLs
function _url_get() {
	view('index');
}

function _url_get_register() {
	require_once PATH_APP . '/controller/create_address.php';
	view('register', createKeyPair());
}

/*
function _url_get_savemessage() {
require_once PATH_APP . '/controller/save_message.php';
}

function _url_get_ecies() {
require_once PATH_APP . '/controller/ecies_demo.php';
}

function _url_get_initdb() {
require_once PATH_APP . '/controller/init_db.php';
}

function _url_get_login($email = NULL) {
if (is_null($email)) {
view('login');
return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "Invalid email format";
return;
}

require_once PATH_APP . '/controller/login.php';
login($email);
}

function _url_post_login($email = NULL) {
if (empty($email)) {
post_view();
} else {
login($email, $_POST['password']);
}
}

function _url_get_login_token($email = '', $token = '') {
if (!check_valid_token($email, $token)) {
echo 'Wrong token! Inform of expired token';
return;
}

echo 'Valid token!';
# TODO: Create session cookie
}
 */

# Handle all the URLs or Not Found
if (!fmap([], '_url')) { # Not found
	http_response_code(404);
	die('Not found!');
}
