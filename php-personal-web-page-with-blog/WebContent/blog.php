<?php
include '_include.php';

setContentTypeHTML();
setIsBlog();

if (isset($_GET[getBlogPostIdParam()])) {
	
	setBlogPostId($_GET[getBlogPostIdParam()]);
	
	if (!existsBlogPost()) {
		redirect('blog.php');
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
		
		if (hasBlogPostDescription()) {
			includeThemeFile('blog-post-description.php');
		}
		
		else {
			readBlogPostContent(true);
			includeThemeFile('blog-post-excerpt.php');
		}
	}
	
	includeThemeFile('page-suffix.php');
}

?>