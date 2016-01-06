<?php

include("settings.php");

if (file_exists(THEME . "/_include.php")) {
	include(THEME . "/_include.php");
}

//
// print funtions

function printTitle() {
	echo TITLE;
}

function printDescription() {
	echo DESCRIPTION;
}

function printKeywords() {
	echo KEYWORDS;
}

function printBlogAuthor() {
	echo BLOG_AUTHOR;
}

function printBlogAuthorImg() {
	echo getGravatarImg(BLOG_AUTHOR_EMAIL);
}

function printBlogAuthorWebsite() {
	echo BLOG_AUTHOR_WEBSITE;
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
