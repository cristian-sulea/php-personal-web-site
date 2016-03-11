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
		
		case "Twitter" :
			return "fa-twitter-square";
		
		case "GitHub" :
			return "fa-github-square";
		
		case "SourceForge" :
			return "fa-pencil-square";
		
		default :
			return "";
	}
}

function updateBlogPostContent($blogPostContentBuffer) {
	
	//
	// replace "<pre>" with "<pre><code>"
	
	$blogPostContentBuffer = str_replace(
			array('<pre>', '</pre>'),
			array('<pre><code>', '</code></pre>'),
			$blogPostContentBuffer);
	
	//
	// add "image" class to <img> parent (<a>)
	
	$dom = new DOMDocument();
	$dom->loadHTML('<div id="xxx-unique-div-container-yyy">' . $blogPostContentBuffer . '</div>');
	
	foreach ( $dom->getElementsByTagName ( "img" ) as $img ) {
		if ($img->parentNode->nodeName == "a") {
			$img->parentNode->setAttribute ( "class", "image" );
		}
	}
	
	$blogPostContentBuffer = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));
	//$blogPostContentBuffer = $dom->saveHTML($dom->getElementById('xxx-unique-div-container-yyy'));
	
	$blogPostContentBuffer = trim($blogPostContentBuffer);
	$blogPostContentBuffer = substr($blogPostContentBuffer, 39, strlen($blogPostContentBuffer) - 39 - 6);
	$blogPostContentBuffer = trim($blogPostContentBuffer);
	
	//
	// return updated content
	
	return $blogPostContentBuffer;
}

function updateSearchResults($searchResultsBuffer) {
	
	$searchResultsSuffix = <<<EOT

<script type="text/javascript">
<!--

// to defer the loading of stylesheets
// just add it right before the </body> tag
// and before any javaScript file inclusion (for performance)  
function loadStyleSheet(src){
    if (document.createStyleSheet) document.createStyleSheet(src);
    else {
        var stylesheet = document.createElement('link');
        stylesheet.href = src;
        stylesheet.rel = 'stylesheet';
        stylesheet.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(stylesheet);
    }
}

loadStyleSheet("themes/html5up-future-imperfect/css/search.css");

//-->
</script>

EOT;
	
	return $searchResultsBuffer . $searchResultsSuffix;
}

?>