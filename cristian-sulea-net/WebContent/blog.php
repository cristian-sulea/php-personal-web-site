<?php

include "__include.php";

$isBlog = true;

include "_include-blog.php";

$params = array_keys($_GET);
if (count($params) > 0) {
	$postId = $params[0];
}

if (isset($postId) && $postId == "feed" && $_GET[$postId] == "rss") {
	
	header ( "Content-Type: application/rss+xml; charset=UTF-8" );
	
	echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
	echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . PHP_EOL;
	echo '<channel>' . PHP_EOL;
	
	echo PHP_EOL;
	
	echo '<title>' . $BLOG_TITLE . '</title>' . PHP_EOL;
	echo '<description>' . $BLOG_DESCRIPTION . '</description>' . PHP_EOL;
	
	echo '<link>' . 'http://' . $_SERVER['HTTP_HOST'] . '</link>' . PHP_EOL;
	echo '<atom:link href="' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '" rel="self" type="application/rss+xml" />' . PHP_EOL;
	
	echo PHP_EOL;
	
	foreach (array_diff(scandir("content/blog/", 1), array(".", "..")) as $file) {
		
		$postId = basename($file);
		
		$postConfig  = json_decode(readContentFile("blog/" . $postId . "/config.json"), TRUE);
		$blogPostContent = readContentFile("blog/" . $postId . "/excerpt.html");
		
		echo "<item>" . PHP_EOL;
		
		echo "	<title>";
		printPostTitle();
		echo "</title>" . PHP_EOL;
		
		echo "	<description><![CDATA[";
		printBlogPostContent();
		echo "]]></description>" . PHP_EOL;
		
		$postLink = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . "?" . $postId;
		echo "	<link>";
		echo $postLink;
		echo "</link>" . PHP_EOL;
		echo "	<guid>";
		echo $postLink;
		echo "</guid>" . PHP_EOL;
		
		echo "	<pubDate>";
		echo date("D, d M Y H:i:s O", strtotime($postConfig["date"]));
		echo "</pubDate>" . PHP_EOL;
		
		echo "</item>" . PHP_EOL;
	}
	
	echo PHP_EOL;
	echo '</channel>' . PHP_EOL;
	echo '</rss>' . PHP_EOL;
}

else if (isset($postId) && existsContentFile("blog/" . $postId)) {
	
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