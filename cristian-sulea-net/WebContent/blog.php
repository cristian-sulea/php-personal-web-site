<?php
header('Content-Type: text/html; charset=UTF-8');

include "__include.php";

$isBlog = true;

include "_include-blog.php";

if (isset($_GET[$BLOG_POST_ID_PARAM]) && !empty($_GET[$BLOG_POST_ID_PARAM])) {
	$postId = $_GET[$BLOG_POST_ID_PARAM];
}

if (isset($postId)) {
	
	if (!existsBlogPost($postId)) {
		header('Location: blog.php');
		exit();
	}
	
	$isBlogPost = true;
	
	$postConfig  = json_decode(readContentFile("blog/" . $postId . "/config.json"), TRUE);
	$blogPostContent = readContentFile("blog/" . $postId . "/content.html");
	
	includeThemeFile("page-prefix.php");
	includeThemeFile("blog-post-full.php");
	includeThemeFile("page-suffix.php");
}

else {
	
	$isBlogPost = false;
	
	includeThemeFile("page-prefix.php");
	
	foreach (array_diff(scandir("content/blog/", 1), array(".", "..")) as $file) {
		
		$postId = basename($file);
		
		$postConfig  = json_decode(readContentFile("blog/" . $postId . "/config.json"), TRUE);
		$blogPostContent = readContentFile("blog/" . $postId . "/excerpt.html");
		
		includeThemeFile("blog-post-excerpt.php");
	}
	
	includeThemeFile("page-suffix.php");
}

?>