<?php
header('Content-Type: text/html; charset=UTF-8');

include "__include.php";

$isBlog = true;

include "_include-blog.php";

if (isset($_GET[$BLOG_POST_ID_PARAM])) {
	$postId = $_GET[$BLOG_POST_ID_PARAM];
}

if (isset($postId)) {
	
	if (!existsBlogPost($postId) || empty($postId)) {
		header('Location: blog.php');
		exit();
	}
	
	$isBlogPost = true;
	
	$postConfig = readBlogPostConfig($postId);
	$blogPostContent = readBlogPostContent($postId);
	
	includeThemeFile("page-prefix.php");
	includeThemeFile("blog-post-full.php");
	includeThemeFile("page-suffix.php");
}

else {
	
	$isBlogPost = false;
	
	includeThemeFile("page-prefix.php");
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		
		$postId = basename($blogPostFolder);
		
		$postConfig = readBlogPostConfig($postId);
		$blogPostContent = readBlogPostExcerpt($postId);
		
		includeThemeFile("blog-post-excerpt.php");
	}
	
	includeThemeFile("page-suffix.php");
}

?>