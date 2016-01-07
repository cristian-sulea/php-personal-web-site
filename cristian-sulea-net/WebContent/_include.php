<?php

$THEME = "_default";

$TITLE       = "Title";
$DESCRIPTION = "Description";
$KEYWORDS    = "";

$META_SEPARATOR = ", ";

$MENU = [
    ["Home", "index.php"],
	["Blog", "blog.php"],
	["Photos", "photos.php"],
];

include("settings.php");

if (file_exists(getThemeFile("/_include.php"))) {
	include(getThemeFile("/_include.php"));
}

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
