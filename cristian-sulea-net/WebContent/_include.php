<?php

//
// default settings

$THEME = "_default";

$TITLE       = "";
$DESCRIPTION = "";
$KEYWORDS    = "";
$AUTHOR      = "";

$META_SEPARATOR = ", ";

$MENU = array(
	array("Blog", "blog.php"),
	array("Photos", "photos.php"),
);

$BLOG_TITLE       = "";
$BLOG_DESCRIPTION = "";

$POST_DATE_FORMAT = "F j, Y";

//
// settings

include("config/settings.php");

//
// theme include

if (file_exists(getThemeFile("_include.php"))) {
	include(getThemeFile("_include.php"));
}

//
// page type

$isIndex     = false;
$isBlog      = false;
$isBlogPost  = false;

//
// getters

function getThemeFile($file) {
	global $THEME;
	return "themes/" . $THEME . "/" . $file;
}

function getMenu() {
	global $MENU;
	return $MENU;
}

function isBlog() {
	global $isBlog;
	return $isBlog;
}

function isBlogPost() {
	global $isBlogPost;
	return $isBlogPost;
}

//
// print funtions

function printThemeFile($file) {
	echo getThemeFile($file);
}

function printTitle() {
	global $TITLE;
	echo $TITLE;
}

function printDescription() {
	global $DESCRIPTION;
	echo $DESCRIPTION;
}

function printKeywords() {
	global $KEYWORDS;
	echo $KEYWORDS;
}

function printAuthor() {
	global $AUTHOR;
	echo $AUTHOR;
}

function printLogo() {
	echo "config/logo.jpg";
}

function printMetaSeparator() {
	global $META_SEPARATOR;
	echo $META_SEPARATOR;
}

function printHtmlHeadTitle() {

	printTitle();

	if (isBlog()) {

		printMetaSeparator();
		printBlogTitle();

		if (isBlogPost()) {
			printMetaSeparator();
			printPostTitle();
		}
	}
}

function printHtmlHeadMetaDescription() {

	if (isBlog()) {

		if (isBlogPost()) {
			printPostTitle();
		}

		else {
			printBlogDescription();
		}
	}

	else {
		printDescription();
	}
}

function printHtmlHeadMetaKeywords() {
	printKeywords();
}

function printHtmlHeadMetaAuthor() {

	if (isBlog()) {

		if (isBlogPost()) {
			printPostTitle();
		}

		else {
			printBlogDescription();
		}
	}

	else {
		printDescription();
	}
}

function printHtmlHeadRelIcon() {

	if (isBlog()) {
		echo "config/blog-icon.png";
	}

	else {
		echo "config/icon.png";
	}
}

//
// utility funtions

function getGravatarImg( $email ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?d=mm";
	return $url;
}

?>
