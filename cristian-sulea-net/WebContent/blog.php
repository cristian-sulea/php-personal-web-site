<?php

include('_include.php');

//
// prefix

include(THEME . '/page-prefix.php');

//
// content blog

$params = array_keys($_GET);
if (count($params) > 0) {
	$postId = $params[0];
}

if (isset($postId) && file_exists("blog/posts/" . $postId)) {

	$postConfig  = json_decode(file_get_contents("blog/posts/" . $postId . "/config.json"), TRUE);
	$postContent = file_get_contents("blog/posts/" . $postId . "/content.html");

	include(THEME . '/blog-post-full.php');
}

else {

	foreach (array_diff(scandir("blog/posts/", 1), array(".", "..")) as $file) {

		$postId = basename($file);

		$postConfig  = json_decode(file_get_contents("blog/posts/" . $postId . "/config.json"), TRUE);
		$postContent = file_get_contents("blog/posts/" . $postId . "/excerpt.html");

		include(THEME . '/blog-post-excerpt.php');
	}
}

//
// suffix

include(THEME . '/page-suffix.php');

//
// functions

function printBlogAuthor() {
	echo BLOG_AUTHOR;
}

function printBlogAuthorImg() {
	echo getGravatarImg(BLOG_AUTHOR_EMAIL);
}

function printBlogAuthorWebsite() {
	echo BLOG_AUTHOR_WEBSITE;
}

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
	echo date(POST_DATE_FORMAT, strtotime($postConfig["date"]));
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
	echo "blog/posts/" . $postId . "/images/". $postConfig["image"];
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

	$printPostContent = str_replace('="images-folder/', '="blog/posts/' . $postId . '/images/', $printPostContent);

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