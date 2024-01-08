<?php
$userLanguage = 'en';

// Load the appropriate language file
$translations = include_once __DIR__ . "/$userLanguage.php";

function _lang($key, $params = []) {
	global $translations;

	if (isset($translations[$key])) {
		$translation = $translations[$key];

		# Replace placeholders with actual values
		foreach ($params as $paramKey => $paramValue) {
			$translation = str_replace(':' . $paramKey, $paramValue, $translation);
		}

		return $translation;
	}

	return $key; // If the key is not found, return the key itself
}

#echo translate('welcome'); // Output: Welcome to our website!
#echo translate('greeting', ['name' => 'John']); // Output: Hello, John!