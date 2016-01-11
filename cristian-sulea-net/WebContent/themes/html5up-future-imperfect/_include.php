<?php

//
// functions

function themeUpdatePostContent($postContent) {

	$postContent = str_replace(
							array('<pre>', '</pre>'),
							array('<pre><code>', '</code></pre>'),
							$postContent);

	return $postContent;
}

function printProfileIconClass($title) {
	switch ($title) {
		
		case "LinkedIn" :
			echo "fa-linkedin-square";
			break;
		
		case "Google+" :
			echo "fa-google-plus-square";
			break;
		
		case "GitHub" :
			echo "fa-github-square";
			break;
		
		case "SourceForge" :
			echo "fa-pencil-square";
			break;
		
		default :
			break;
	}
}

?>