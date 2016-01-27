<?php

//
// default settings

$THEME = "_default";

$AUTHOR_NAME        = "";
$AUTHOR_DESCRIPTION = "";
$AUTHOR_BIRTHDAY    = "";
$AUTHOR_ADDRESS     = "";
$AUTHOR_KEYWORDS    = "";
$AUTHOR_PROFILES = array ();

$BLOG_TITLE       = "";
$BLOG_DESCRIPTION = "";
$BLOG_KEYWORDS    = "";

$BLOG_POST_ID_PARAM = 'p';
$BLOG_POST_DATE_FORMAT = "F j, Y";

$MENU = array(
		array("Blog", "blog.php"),
		// 	array("Photos", "photos.php")
);

$GOOGLE_ANALYTICS_TRACKING_CODE = <<<EOT
EOT;

include "config/settings.php";

function getBlogPostIdParam() {
	global $BLOG_POST_ID_PARAM;
	return $BLOG_POST_ID_PARAM;
}
function getBlogPostDateFormat() {
	global $BLOG_POST_DATE_FORMAT;
	return $BLOG_POST_DATE_FORMAT;
}
function getMenu() {
	global $MENU;
	return $MENU;
}
function getGoogleAnalyticsTrackingCode() {
	global $GOOGLE_ANALYTICS_TRACKING_CODE;
	echo $GOOGLE_ANALYTICS_TRACKING_CODE;
}
function printGoogleAnalyticsTrackingCode() {
	echo getGoogleAnalyticsTrackingCode();
}

//
// theme include

if (existsThemeFile("_include-theme.php")) {
	include _getThemeFile("_include-theme.php");
}

//
// the new sh!t

global $blogPostId;
function setBlogPostId($blogPostIdNew) {
	global $blogPostId;
	$blogPostId = $blogPostIdNew;
}
function getBlogPostId() {
	global $blogPostId;
	checkIfIsSet($blogPostId);
	return $blogPostId;
}
function getBlogPostLink() {
	return 'blog.php?' . getBlogPostIdParam() . '=' . getBlogPostId();
}
function printBlogPostLink() {
	echo getBlogPostLink();
}

//
// blog post config

global $postConfig;
function setBlogPostConfig($blogPostConfigNew) {
	global $postConfig;
	$postConfig = $blogPostConfigNew;
}
function getBlogPostConfig($key=null) {
	global $postConfig;
	checkIfIsSet($postConfig);
	if (isset($key)) {
		if (isset($postConfig[$key])) {
			return $postConfig[$key];
		} else {
			return null;
		}
	} else {
		return $postConfig;
	}
}

//
// blog post config
// - title

function getBlogPostTitle() {
	return getBlogPostConfig('title');
}
function printBlogPostTitle() {
	echo getBlogPostTitle();
}

//
// blog post config
// - date

function getBlogPostDate($format = null) {
	if (isset($format)) {
		return date($format, strtotime(getBlogPostConfig('date')));
	} else {
		return date(getBlogPostDateFormat(), strtotime(getBlogPostConfig('date')));
	}
}
function printBlogPostDate($format = null) {
	echo getBlogPostDate($format);
}
function printBlogPostDateForHtmlTimeTag() {
	echo getBlogPostDate('Y-m-d');
}

//
// blog post config
// - resources

function getBlogPostResources() {
	return getBlogPostConfig('resources');
}
function hasBlogPostResources() {
	return null !== getBlogPostResources();
}
function printBlogPostResources() {
	global $postConfig;
	echo  PHP_EOL;
	echo '<b>Resources</b>' . PHP_EOL;
	echo '<ul id="blog-post-resources">' . PHP_EOL;
	foreach (getBlogPostResources() as $resource) {
		echo '<li><a href="' . $resource[1] . '">' . $resource[0] . '</a></li>' . PHP_EOL;
	}
	echo '</ul>';
}

//
// blog post content

global $blogPostContent;
function setBlogPostContent($blogPostContentNew) {
	global $blogPostContent;
	$blogPostContent = $blogPostContentNew;
}
function getBlogPostContent() {
	global $blogPostContent;
	return $blogPostContent;
}

//
// page type

$isIndex     = false;
$isBlog      = false;
$isBlogFeed  = false;
$isBlogPost  = false;

function isIndex() {
	global $isIndex;
	return $isIndex;
}
function setIsIndex() {
	global $isIndex;
	$isIndex = true;
}
function isBlog() {
	global $isBlog;
	return $isBlog;
}
function setIsBlog() {
	global $isBlog;
	$isBlog = true;
}
function isBlogFeed() {
	global $isBlogFeed;
	return $isBlogFeed;
}
function setIsBlogFeed() {
	global $isBlogFeed;
	$isBlogFeed = true;
}
function isBlogPost() {
	global $isBlogPost;
	return $isBlogPost;
}
function setIsBlogPost() {
	global $isBlogPost;
	$isBlogPost = true;
}

//
// page content type

function setContentType($contentType) {
	header('Content-Type: ' . $contentType . '; charset=UTF-8');
}
function setContentTypeHTML() {
	setContentType('text/html');
}
function setContentTypeRSS() {
	setContentType('application/rss+xml');
}
function setContentTypeXML() {
	setContentType('application/rss+xml');
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

function getBlogPostFolders() {
	return array_diff(scandir('content/blog/', 1), array(".", ".."));
}

function existsBlogPost() {
	return getBlogPostId() && file_exists('content/blog/' . getBlogPostId());
}
function readBlogPostConfig() {
	setBlogPostConfig(json_decode(file_get_contents('content/blog/' . getBlogPostId() . '/config.json'), TRUE));
}
function readBlogPostContent($useExcerpt = false) {
	if ($useExcerpt) {
		setBlogPostContent(file_get_contents('content/blog/' . getBlogPostId() . '/excerpt.html'));
	} else {
		setBlogPostContent(file_get_contents('content/blog/' . getBlogPostId() . '/content.html'));
	}
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
function printAuthorKeywords($prefix = '', $sufix = '') {
	global $AUTHOR_KEYWORDS;
	echo $prefix . $AUTHOR_KEYWORDS . $sufix;
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
function printBlogKeywords($prefix = '', $sufix = '') {
	global $BLOG_KEYWORDS;
	echo $prefix . $BLOG_KEYWORDS . $sufix;
}

function printMenuItems() {
	foreach (getMenu() as $menu) {
		theme_printMenuItem($menu[0], $menu[1]);
	}
}

//
// print HTML components

function printHtmlHeadTitle() {
	
	if (isIndex()) {
		printAuthorName();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			printBlogPostTitle();
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
			printBlogPostTitle();
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
	
	if (isIndex()) {
		printAuthorKeywords();
	}
	
	else if (isBlog()) {
	
		if (isBlogPost()) {
			printBlogPostKeywords('', ', ');
			printAuthorKeywords();
		}
	
		else {
			printAuthorKeywords();
			printBlogKeywords(', ', '');
		}
	}
	
	else {
		errorUnknownPageType();
	}
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
	echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
function printHtmlHeadLinkShortlink() {
	echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

//
// utility funtions

function getAbsoluteLink($page='') {

	$linkPrefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$linkPrefix .= $_SERVER ['HTTP_HOST'];
	$linkPrefix .= $_SERVER ['REQUEST_URI'];

	return dirname($linkPrefix) . '/' . $page;
}

function errorUnknownPageType() {
	trigger_error("unknown page type", E_USER_ERROR);
}

function checkIfIsSet($param) {
	if (!isset($param)) {
		trigger_error('parameter <b>' . get_var_name($param) . '</b> not set', E_USER_ERROR);
	}
}

function get_var_name($var) {
	foreach($GLOBALS as $var_name => $value) {
		if ($value === $var) {
			return $var_name;
		}
	}
	return false;
}

function redirect($url) {
	header('Location: ' . $url);
	exit();
}

function getGravatarImg( $email ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?d=mm";
	return $url;
}

?>
