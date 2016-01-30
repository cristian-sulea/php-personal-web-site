<?php
include '_include.php';

setContentTypeTEXT();

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	setBlogPostId(basename($blogPostFolder));
	
	echo 'RewriteRule ^blog.php?' . $blogPostFolder . ' /' . getBlogPostLink() . ' [R=301,L]';
	echo PHP_EOL;
	
}

?>