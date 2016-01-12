<?php

//
// settings

$THEME = "_default";

$AUTHOR_NAME        = "Cristian Sulea";
$AUTHOR_DESCRIPTION = "Software Architect &amp; Developer";

$KEYWORDS    = "cristian sulea, sulea cristian, cristian, sulea";

$BLOG_TITLE       = "Knowlegde Base";
$BLOG_DESCRIPTION = "An archive of my personal knowledge base.";

$BLOG_POST_DATE_FORMAT = "F j, Y";

$MENU = array(
		array("Blog", "blog.php"),
		// 	array("Photos", "photos.php"),
);

function getTheme() {
	global $THEME;
	return $THEME;
}

function getAuthorName() {
	global $AUTHOR_NAME;
	return $AUTHOR_NAME;
}
function getAuthorDescription() {
	global $AUTHOR_DESCRIPTION;
	return $AUTHOR_DESCRIPTION;
}

function getKeywords() {
	global $KEYWORDS;
	return $KEYWORDS;
}

function getBlogTitle() {
	global $BLOG_TITLE;
	return $BLOG_TITLE;
}
function getBlogDescription() {
	global $BLOG_DESCRIPTION;
	return $BLOG_DESCRIPTION;
}

function getBlogPostDateFormat() {
	global $BLOG_POST_DATE_FORMAT;
	return $BLOG_POST_DATE_FORMAT;
}

function getMenu() {
	global $MENU;
	return $MENU;
}

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
// theme

function _getThemeFile($file) {
	return "themes/" . getTheme() . "/" . $file;
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

//
// content

function _getContentFile($file) {
	return "content/" . $file;
}
function existsContentFile($file) {
	return file_exists(_getContentFile($file));
}
function readContentFile($file) {
	return file_get_contents(_getContentFile($file));
}

//
// print funtions

function printHtmlHeadTitle() {
	
	if (isIndex()) {
		echo getAuthorName();
	}
	
	else if (isBlog()) {
		
		echo getAuthorName();
		echo ", ";
		printBlogTitle();
		
		if (isBlogPost()) {
			echo ", ";
			printPostTitle();
		}
	}
	
	else {
		errorUnknownPageType();
	}
}

function printHtmlHeadMetaDescription() {
	
	if (isIndex()) {
		printIndexDescription();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			printPostTitle();
		}
		
		else {
			printBlogDescription();
		}
	}
	
	else {
		errorUnknownPageType();
	}
}

function printHtmlHeadMetaKeywords() {
	echo getKeywords();
}

function printHtmlHeadMetaAuthor() {
	
	if (isIndex()) {
		echo getAuthorName();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			printPostAuthor();
		}
		
		else {
			printBlogAuthor();
		}
	}
	
	else {
		errorUnknownPageType();
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

function errorUnknownPageType() {
	trigger_error("unknown page type", E_USER_ERROR);
}

function getGravatarImg( $email ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?d=mm";
	return $url;
}

?>
