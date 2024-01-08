<?php
function gemtextToHtml($gemtext) {
	$html = '';
	$lines = explode("\n", $gemtext);
	$openPre = false;
	foreach ($lines as $line) {
		if ($openPre) {
			if (str_starts_with($line, '```')) {
				$openPre = false;
				$html .= "</pre>\n";
			} else {
				$html .= "$line";
			}

			continue;
		}

		if (str_starts_with($line, '#')) {
			$level = substr_count($line, '#', 0, 3);
			$content = trim(substr($line, $level));
			$html .= "<h$level>$content</h$level>\n";
		} elseif (substr($line, 0, 1) == '*') {
			$content = trim(substr($line, 1));
			$html .= "<li>{$content}</li>\n";
		} elseif (substr($line, 0, 1) == '>') {
			$content = trim(substr($line, 1));
			$html .= "<blockquote>{$content}</blockquote>\n";
		} elseif (str_starts_with($line, '```')) {
			$content = trim(substr($line, 3));

			if (!$openPre) {
				$html .= "<pre>\n";
				$openPre = true;
			}

		} elseif (substr($line, 0, 2) == '=>') {
			$parts = explode(' ', trim(substr($line, 2)), 2);
			$url = $parts[0];
			$text = isset($parts[1]) ? $parts[1] : $url;
			$html .= "<p><a href=\"{$url}\">{$text}</a></p>\n";
		} elseif (str_starts_with($line, "\r") || str_starts_with($line, "\n")) {
			$html .= "\n";
		} else {
			$html .= "<p>{$line}</p>\n";
		}
	}
	return $html;
}

// $data = "
// # Top level title
// ## Second level title
// ### Third level title

// * List item
// * List item

// > Quoted text

// ``` Text
// Preformatted text
// ```
// => https://owl.eapl.me This is a link
// => https://owl.eapl.me
// ";
// echo '<link href="style.css" rel="stylesheet">';
// echo gemtextToHtml($data);