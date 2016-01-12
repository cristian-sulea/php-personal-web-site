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
// 	array("Photos", "photos.php"),
);

$BLOG_TITLE       = "";
$BLOG_DESCRIPTION = "";

$POST_DATE_FORMAT = "F j, Y";

//
// settings

include "config/settings.php";

//
// theme include

if (existsThemeFile("_include.php")) {
	includeThemeFile("_include.php");
}

//
// page type

$isIndex     = false;
$isBlog      = false;
$isBlogPost  = false;

function isIndex() {
	global $isIndex;
	return $isIndex;
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
// getters

function _getThemeFile($file) {
	global $THEME;
	return "themes/" . $THEME . "/" . $file;
}
function includeThemeFile($file) {
	include _getThemeFile($file);
}
function existsThemeFile($file) {
	return file_exists(_getThemeFile($file));
}
function printThemeFile($file) {
	echo _getThemeFile($file);
}

function _getContentFile($file) {
	return "content/" . $file;
}
function readContentFile($file) {
	return file_get_contents(_getContentFile($file));
}

function getMenu() {
	global $MENU;
	return $MENU;
}

//
// print funtions



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

	if (isBlog()) {

		printTitle();
		printMetaSeparator();
		printBlogTitle();

		if (isBlogPost()) {
			printMetaSeparator();
			printPostTitle();
		}
	}

	else {
		printTitle();
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
			printPostAuthor();
		}

		else {
			printBlogAuthor();
		}
	}

	else {
		printAuthor();
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
