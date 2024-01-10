<?php
$title = "Owl Messenger 🦉";

include_once PATH_APP . '/view/partials/base.php';
include_once PATH_APP . '/view/partials/header.php';
?>
<h1><a href="/">🦉 Owl Messenger</a></h1>
<h2>Send a message</h2>
<form action="/signandpreview" method="post">
	<div class="field" id="field-to">
		<label for="to">To (Address)</label>
		<input type="text" name="to" id="to" autocomplete="on" placeholder="Address" required disabled value="<?= $address ?>">
	</div>

	<div class="field" id="field-title">
		<label for="title">Your SECRET (don't paste anywhere else)</label>
		<input type="text" name="title" id="title" value="" autocomplete="off" placeholder="Secret" required>
	</div>

	<div class="field" id="field-content">
		<label for="content">Message (<a href="/gemtext" target="_blank">Style it with Gemtext</a>)</label>
		<textarea class="editor" name="content" placeholder="Start typing..." id="content" rows="6" cols="49" required></textarea>
	</div>

	<input type="submit" value="Submit">
</form>

<?php
include_once PATH_APP . '/view/partials/footer.php';