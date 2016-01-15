<?php

//
// settings

$THEME = "_default";

$AUTHOR_NAME        = "";
$AUTHOR_DESCRIPTION = "";
$AUTHOR_BIRTHDAY    = "";
$AUTHOR_ADDRESS     = "";

$AUTHOR_PROFILES = array ();

$BLOG_TITLE       = "";
$BLOG_DESCRIPTION = "";

$BLOG_POST_DATE_FORMAT = "F j, Y";

$KEYWORDS = "";

$MENU = array(
		array("Blog", "blog.php"),
		// 	array("Photos", "photos.php")
);

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

if (existsThemeFile("_include-theme.php")) {
	include _getThemeFile("_include-theme.php");
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

function printAuthorName() {
	global $AUTHOR_NAME;
	echo $AUTHOR_NAME;
}
function printAuthorDescription() {
	global $AUTHOR_DESCRIPTION;
	echo $AUTHOR_DESCRIPTION;
}
function printAuthorBirthday() {
	global $AUTHOR_BIRTHDAY;
	echo $AUTHOR_BIRTHDAY;
}
function printAuthorAddress() {
	global $AUTHOR_ADDRESS;
	echo $AUTHOR_ADDRESS;
}

function printAuthorProfiles() {
	global $AUTHOR_PROFILES;
	foreach ($AUTHOR_PROFILES as $authorProfile) {
		theme_printAuthorProfile($authorProfile[0], $authorProfile[1]);
	}
}

function printBlogTitle() {
	global $BLOG_TITLE;
	echo $BLOG_TITLE;
}
function printBlogDescription() {
	global $BLOG_DESCRIPTION;
	echo $BLOG_DESCRIPTION;
}

function printKeywords() {
	global $KEYWORDS;
	echo $KEYWORDS;
}

function printMenuItems() {
	foreach (getMenu() as $menu) {
		theme_printMenuItem($menu[0], $menu[1]);
	}
}

function printHtmlHeadTitle() {
	
	if (isIndex()) {
		printAuthorName();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			printPostTitle();
			echo ", ";
		}
		
		printBlogTitle();
		echo ", ";
		printAuthorName();
	}
	
	else {
		errorUnknownPageType();
	}
}

function printHtmlHeadMetaDescription() {
	
	if (isIndex()) {
		printAuthorDescription();
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
	printKeywords();
}

function printHtmlHeadMetaAuthor() {
	
	if (isIndex()) {
		printAuthorName();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			printPostAuthor();
		}
		
		else {
			printAuthorName();
		}
	}
	
	else {
		errorUnknownPageType();
	}
}

function printHtmlHeadLinkIcon() {
	
	if (isIndex()) {
		echo "config/index-icon.png";
	}
	
	else if (isBlog()) {
		echo "config/blog-icon.png";
	}
	
	else {
		errorUnknownPageType();
	}
}

function printHtmlHeadLinkCanonical() {
	echo 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}
function printHtmlHeadLinkShortlink() {
	echo 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
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
