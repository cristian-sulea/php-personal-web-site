<?php

include "_include.php";
$isBlog = true;

//
// content blog

$params = array_keys($_GET);
if (count($params) > 0) {
	$postId = $params[0];
}

if (isset($postId) && existsContentFile("blog/" . $postId)) {

	$isBlogPost = true;

	$postConfig  = json_decode(file_get_contents("content/blog/" . $postId . "/config.json"), TRUE);
	$postContent = file_get_contents("content/blog/" . $postId . "/content.html");

	includeThemeFile("page-prefix.php");
	includeThemeFile("blog-post-full.php");

} else {

	$isBlogPost = false;

	includeThemeFile("page-prefix.php");

	foreach (array_diff(scandir("content/blog/", 1), array(".", "..")) as $file) {

		$postId = basename($file);

		$postConfig  = json_decode(file_get_contents("content/blog/" . $postId . "/config.json"), TRUE);
		$postContent = file_get_contents("content/blog/" . $postId . "/excerpt.html");

		includeThemeFile("blog-post-excerpt.php");
	}
}

includeThemeFile("page-suffix.php");

//
// functions blog

function printBlogTitle() {
	global $BLOG_TITLE;
	echo $BLOG_TITLE;
}

function printBlogDescription() {
	global $BLOG_DESCRIPTION;
	echo $BLOG_DESCRIPTION;
}

function printBlogLogo() {
	echo "config/blog-logo.jpg";
}

function printBlogAuthor() {
	printAuthor();
}

function printBlogAuthorImg() {
	echo "config/blog-author.jpg";
}

function printBlogAuthorWebsite() {
	echo "http://" . $_SERVER['HTTP_HOST'];
}

//
// functions blog post

function printPostId() {
	global $postId;
	echo $postId;
}

function printPostTitle() {
	global $postConfig;
	echo $postConfig["title"];
}

function printPostDate() {
	global $postConfig;
	global $POST_DATE_FORMAT;
	echo date($POST_DATE_FORMAT, strtotime($postConfig["date"]));
}

function printPostDateForTimeTag() {
	global $postConfig;
	echo date("Y-m-d", strtotime($postConfig["date"]));
}

function printPostAuthor() {
	global $postConfig;
	if (isset($postConfig["author"])) {
		echo $postConfig["author"];
	} else {
		printBlogAuthor();
	}
}

function printPostAuthorImg() {
	global $postConfig;
	if (isset($postConfig["author-email"])) {
		echo getGravatarImg($postConfig["author-email"]);
	} else {
		if (isset($postConfig["author"])) {
			echo getGravatarImg("");
		} else {
			printBlogAuthorImg();
		}
	}
}

function printPostAuthorWebsite() {
	global $postConfig;
	if (isset($postConfig["author-website"])) {
		echo $postConfig["author-website"];
	} else {
		if (isset($postConfig["author"])) {
			echo "";
		} else {
			printBlogAuthorWebsite();
		}
	}
}

function hasPostDescription() {
	global $postConfig;
	return isset($postConfig["description"]);
}

function printPostDescription() {
	global $postConfig;
	echo $postConfig["description"];
}

function hasPostImage() {
	global $postConfig;
	return isset($postConfig["image"]);
}

function printPostImage() {
	global $postId;
	global $postConfig;
	echo "content/blog/" . $postId . "/images/". $postConfig["image"];
}

function printPostContent($imgParentClass = 'null') {
	global $postContent;
	global $postId;

	$printPostContent = $postContent;

	if ($imgParentClass == 'null') {
		$printPostContent = str_replace(array(' class="img-parent-class"'), '', $printPostContent);
	} else {
		$printPostContent = str_replace(array('class="img-parent-class"'), array('class="' . $imgParentClass . '"'), $printPostContent);
	}

	$printPostContent = str_replace('="images-folder/', '="content/blog/' . $postId . '/images/', $printPostContent);

	$printPostContent = str_replace(
								array('<pre>' . "\r\n",
									  '<pre>' . "\r",
									  '<pre>' . "\n",
									  '<pre>' . "\n\r"),
								'<pre>',
								$printPostContent);

	if (function_exists('themeUpdatePostContent')) {
		$printPostContent = themeUpdatePostContent($printPostContent);
	}

	echo PHP_EOL;
	echo $printPostContent;
}

function hasPostResources() {
	global $postConfig;
	return isset($postConfig["resources"]);
}

function printPostResources() {
	global $postConfig;
	echo  PHP_EOL;
	echo '<b>Resources</b>' . PHP_EOL;
	echo '<ul>' . PHP_EOL;
	foreach ($postConfig["resources"] as $resource) {
		echo '<li><a href="' . $resource[1] . '">' . $resource[0] . '</a></li>' . PHP_EOL;
	}
	echo '</ul>';
}

?>