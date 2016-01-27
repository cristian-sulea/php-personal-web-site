<?php

//
// logo

function printBlogLogo() {
	echo "config/blog-logo.jpg";
}

//
// print

function printBlogPostKeywords($prefix = '', $sufix = '') {
	global $postConfig;
	
	if (isset($postConfig["keywords"])) {
		foreach ($postConfig["keywords"] as $keyword) {
			echo $prefix . $keyword . $sufix;
		}
	}
}

function printPostAuthor() {
	global $postConfig;
	if (isset($postConfig["author"])) {
		echo $postConfig["author"];
	} else {
		printAuthorName();
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
			echo "config/blog-author.jpg";
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
			echo "http://" . $_SERVER['HTTP_HOST'];
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
	global $postConfig;
	echo "content/blog/" . getBlogPostId() . "/images/". $postConfig["image"];
}

?>