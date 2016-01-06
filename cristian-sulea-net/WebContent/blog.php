<?php

//
// default include

include('_include.php');

//
// suffix

include(THEME . '/page-prefix.php');

//
// blog

$params = array_keys($_GET);
if (count($params) > 0) {
	$postId = $params[0];
}

if (isset($postId)) {

	$postConfig  = json_decode(file_get_contents("blog/posts/" . $postId . "/config.json"), TRUE);

	$postTitle = $postConfig["title"];
	$postDate = $postConfig["date"];
	$postContent = file_get_contents("blog/posts/" . $postId . "/content.html");
	include(THEME . '/post.php');
}

//
// suffix

include(THEME . '/page-suffix.php');

//
// functions

function printPostTitle() {
	global $postTitle;
	echo $postTitle;
}

function printPostDate() {
	global $postDate;
	echo date(POST_DATE_FORMAT, strtotime($postDate));
}

function printPostDateForTimeTag() {
	global $postDate;
	echo date("Y-m-d", strtotime($postDate));
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