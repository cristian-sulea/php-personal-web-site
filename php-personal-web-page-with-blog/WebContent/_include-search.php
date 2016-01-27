<?php

//
// print

function printSearchQuery() {
	global $searchQuery;
	echo $searchQuery;
}

function printSearchResults() {
	global $searchResults;
	
	if (function_exists('theme_printSearchResults')) {
		theme_printSearchResults($searchResults);
	}
	
	else {
		echo $searchResults;
	}
}

?>