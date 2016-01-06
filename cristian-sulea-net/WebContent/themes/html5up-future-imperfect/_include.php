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

?>