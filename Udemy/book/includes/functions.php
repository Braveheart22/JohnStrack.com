<?php
// FUNCTIONS.php
// clean the form data to prevent injections
/*
	Built in functions used:
	Trim()
	StripSlashes()
	htmlSpecialChars()
	strip_tags()
	str_replace()
*/

function validateFormData($formData) {
	$formData = trim(StripSlashes(htmlSpecialChars(strip_tags(str_replace(array('(', ')'), '', $formData)), ENT_QUOTES)));
	return $formData;
}
?>