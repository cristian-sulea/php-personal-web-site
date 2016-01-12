<?php

//
// functions

function themeUpdatePostContent($postContent) {
	
	//
	// replace "<pre>" with "<pre><code>"
	
	$postContent = str_replace(
							array('<pre>', '</pre>'),
							array('<pre><code>', '</code></pre>'),
							$postContent);
	
	//
	// add "image" class to <img> <a> parent
	
	$dom = new DOMDocument();
	$dom->loadHTML($postContent);
	
	foreach ( $dom->getElementsByTagName ( "img" ) as $img ) {
		if ($img->parentNode->nodeName == "a") {
			$img->parentNode->setAttribute ( "class", "image" );
		}
	}
	
	$postContent = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
	
	//
	// return updated $postContent
	
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