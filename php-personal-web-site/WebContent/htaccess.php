<?php
include '_include.php';

setContentTypeTEXT();

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	setBlogPostId(basename($blogPostFolder));
	
	echo 'RewriteCond %{QUERY_STRING} ^' . $blogPostFolder . PHP_EOL;
	echo 'RewriteRule ^blog.php /'. getBlogPostLink() .' [R=301,L]' . PHP_EOL;
	
}

?>