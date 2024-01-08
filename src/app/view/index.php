<?php
$title = "Owl Messenger 🦉";

include_once PATH_APP . '/view/partials/base.php';
include_once PATH_APP . '/view/partials/header.php';
?>
<h1>Owl Messenger 🦉</h1>
<p>Welcome!</p>
<p><a href="/register">📧Create your address</a></p>
<p><a href="/inbox">📬Inbox</a></p>
<hr>
<p>Owl is a minimalist, encrypted and centralized messaging service.</p>
<p>It's a proof of concept and doesn't intend to replace email or any other service.</p>
<p>Use it at your own risk. Check the source code for any vulnerabilities!</p>
<p><a href="/moreinfo">🤔 More info!</a></p>
<?php
include_once PATH_APP . '/view/partials/footer.php';