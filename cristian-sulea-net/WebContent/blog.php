<?php
include '__include.php';

setContentTypeHTML();
setIsBlog();

include '_include-blog.php';

if (isset($_GET[$BLOG_POST_ID_PARAM])) {
	
	setBlogPostId($_GET[$BLOG_POST_ID_PARAM]);
	
	if (!existsBlogPost()) {
		header('Location: blog.php');
		exit();
	}
	
	setIsBlogPost();
	
	readBlogPostConfig();
	readBlogPostContent();
	
	includeThemeFile('page-prefix.php');
	includeThemeFile('blog-post-full.php');
	includeThemeFile('page-suffix.php');
}

else {
	
	includeThemeFile('page-prefix.php');
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		
		setBlogPostId(basename($blogPostFolder));
		
		readBlogPostConfig();
		readBlogPostContent(true);
		
		includeThemeFile('blog-post-excerpt.php');
	}
	
	includeThemeFile('page-suffix.php');
}

?>