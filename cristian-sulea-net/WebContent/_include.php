<?php

//
// settings

define("THEME", "themes/html5up-future-imperfect");

define("BLOG_TITLE", "Blog Title: Future Imperfect");
define("BLOG_AUTHOR", "Cristian Sulea");
define("BLOG_AUTHOR_EMAIL", "cristian.sulea.79@gmail.com");
define("BLOG_AUTHOR_WEBSITE", "http://cristian.sulea.net");

define("POST_DATE_FORMAT", "F j, Y");

//
// print funtions

function printBlogTitle() {
	echo BLOG_TITLE;
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
