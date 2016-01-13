<?php

function theme_printMenuItem($title, $link) {
	echo PHP_EOL;
	echo '<li><a href="' . $link . '">' . $title . '</a></li>';
}

function theme_printAuthorProfile($title, $link) {
	echo PHP_EOL;
	echo '<li><a href="' . $link . '" class="' . theme_getAuthorProfileIconClass($title) .  '">&nbsp;' . $title . '</a></li>';
}

function theme_getAuthorProfileIconClass($title) {
	
	switch ($title) {
		
		case "LinkedIn" :
			return "fa-linkedin-square";
		
		case "Google+" :
			return "fa-google-plus-square";
		
		case "GitHub" :
			return "fa-github-square";
		
		case "SourceForge" :
			return "fa-pencil-square";
		
		default :
			return "";
	}
}

function theme_printBlogPostContent($blogPostContent) {
	
	//
	// replace "<pre>" with "<pre><code>"
	
	$blogPostContent = str_replace(
			array('<pre>', '</pre>'),
			array('<pre><code>', '</code></pre>'),
			$blogPostContent);
	
	//
	// add "image" class to <img> parent (<a>)
	
	$dom = new DOMDocument();
	$dom->loadHTML($blogPostContent);
	
	foreach ( $dom->getElementsByTagName ( "img" ) as $img ) {
		if ($img->parentNode->nodeName == "a") {
			$img->parentNode->setAttribute ( "class", "image" );
		}
	}
	
	$blogPostContent = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
	
	//
	// print updated content
	
	echo $blogPostContent;
}

?>