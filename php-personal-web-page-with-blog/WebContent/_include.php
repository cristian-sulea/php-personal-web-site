<?php

//
// default settings

$THEME = "_default";

$AUTHOR_NAME        = "";
$AUTHOR_DESCRIPTION = "";
$AUTHOR_WEBSITE     = "";
$AUTHOR_BIRTHDAY    = "";
$AUTHOR_ADDRESS     = "";
$AUTHOR_KEYWORDS    = "";
$AUTHOR_PROFILES = array ();

$BLOG_TITLE       = "";
$BLOG_DESCRIPTION = "";
$BLOG_KEYWORDS    = "";

$BLOG_POST_ID_PARAM = 'p';
$BLOG_POST_DATE_FORMAT = "F j, Y";

$SEARCH_QUERY_PARAM = 'q';

$MENU = array(
		array("Blog", "blog.php"),
		// 	array("Photos", "photos.php")
);

$GOOGLE_ANALYTICS_TRACKING_CODE = <<<EOT
EOT;

function getAuthorWebsite() {
	global $AUTHOR_WEBSITE;
	return $AUTHOR_WEBSITE;
}
function printAuthorWebsite() {
	echo getAuthorWebsite();
}

function getBlogTitle() {
	global $BLOG_TITLE;
	return $BLOG_TITLE;
}
function printBlogTitle() {
	echo getBlogTitle();
}

function getBlogDescription() {
	global $BLOG_DESCRIPTION;
	echo $BLOG_DESCRIPTION;
}
function printBlogDescription() {
	echo getBlogDescription();
}

function getBlogKeywords() {
	global $BLOG_KEYWORDS;
	echo $BLOG_KEYWORDS;
}
function printBlogKeywords($prefix = '', $sufix = '') {
	echo $prefix . getBlogKeywords() . $sufix;
}

function getBlogPostIdParam() {
	global $BLOG_POST_ID_PARAM;
	return $BLOG_POST_ID_PARAM;
}
function getBlogPostDateFormat() {
	global $BLOG_POST_DATE_FORMAT;
	return $BLOG_POST_DATE_FORMAT;
}

function getSearchQueryParam() {
	global $SEARCH_QUERY_PARAM;
	return $SEARCH_QUERY_PARAM;
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
// include

include 'config/settings.php';

includeThemeFileIfExists('_include-theme.php');

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
// themes files

function getThemeFile($file) {
	global $THEME;
	return "themes/" . $THEME . "/" . $file;
}

function printThemeFile($file) {
	echo getThemeFile($file);
}

function includeThemeFile($file) {
	include getThemeFile($file);
}

function includeThemeFileIfExists($file) {
	$file = getThemeFile($file);
	if (file_exists($file)) {
		include $file;
	}
}

//
// index
// - logo

function printIndexLogo() {
	echo 'config/index-logo.jpg';
}

//
// index
// - experience

global $indexExperience;

function setIndexExperience($indexExperienceNew) {
	global $indexExperience;
	$indexExperience = $indexExperienceNew;
}

function getIndexExperience() {
	global $indexExperience;
	checkIfIsSet($indexExperience);
	return $indexExperience;
}

function readIndexExperience() {
	setIndexExperience(new DOMDocument());
	getIndexExperience()->loadXML(file_get_contents('content/index/experience.xml'));
}

function printIndexExperienceTitle() {
	global $indexExperience;
	echo $indexExperience->documentElement->getAttribute("title");
}

function printIndexExperience() {
	global $indexExperience;

	foreach($indexExperience->getElementsByTagName('position') as $position) {

		$title = $position->getElementsByTagName("title")->item(0)->textContent;
		$company = $position->getElementsByTagName("company")->item(0)->textContent;
		$period = $position->getElementsByTagName("period")->item(0)->textContent;
		$location = $position->getElementsByTagName("location")->item(0)->textContent;

		$description = $position->getElementsByTagName("description");
		if ($description->length > 0) {
			$description = $description->item(0)->textContent;
		} else {
			$description = "";
		}

		printExperiencePosition($title, $company, $period, $location, $description);
	}
}

//
// index
// - skills

global $indexSkills;

function setIndexSkills($indexSkillsNew) {
	global $indexSkills;
	$indexSkills = $indexSkillsNew;
}

function getIndexSkills() {
	global $indexSkills;
	checkIfIsSet($indexSkills);
	return $indexSkills;
}

function readIndexSkills() {
	setIndexSkills(new DOMDocument());
	getIndexSkills()->loadXML(file_get_contents('content/index/skills.xml'));
}

function printIndexSkillsTitle() {
	global $indexSkills;
	echo $indexSkills->documentElement->getAttribute("title");
}

function printIndexSkills() {
	global $indexSkills;

	foreach($indexSkills->getElementsByTagName('group') as $group) {

		$title = $group->getElementsByTagName("title")->item(0)->textContent;
		$description = $group->getElementsByTagName("description")->item(0)->textContent;

		printSkillsGroup($title, $description);
	}
}

//
// index
// - languages

global $indexLanguages;

function setIndexLanguages($indexLanguagesNew) {
	global $indexLanguages;
	$indexLanguages = $indexLanguagesNew;
}

function getIndexLanguages() {
	global $indexLanguages;
	checkIfIsSet($indexLanguages);
	return $indexLanguages;
}

function readIndexLanguages() {
	setIndexLanguages(new DOMDocument());
	getIndexLanguages()->loadXML(file_get_contents('content/index/languages.xml'));
}

function printIndexLanguagesTitle() {
	global $indexLanguages;
	echo $indexLanguages->documentElement->getAttribute("title");
}

function printIndexLanguages() {
	global $indexLanguages;

	foreach($indexLanguages->getElementsByTagName('language') as $language) {

		$name = $language->getElementsByTagName("name")->item(0)->textContent;
		$level = $language->getElementsByTagName("level")->item(0)->textContent;

		printLanguagesLanguage($name, $level);
	}
}

//
// blog
// - logo

function printBlogLogo() {
	echo 'config/blog-logo.jpg';
}

//
// blog post ID

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

function existsBlogPost() {
	return getBlogPostId() && file_exists('content/blog/' . getBlogPostId());
}

//
// blog post config

global $postConfig;

function setBlogPostConfig($blogPostConfigNew) {
	global $postConfig;
	$postConfig = $blogPostConfigNew;
}

function getBlogPostConfig($key = null, $keyIsMandatory = true) {
	global $postConfig;
	checkIfIsSet($postConfig);
	if (isset($key)) {
		if ($keyIsMandatory) {
			checkIfIsSet($postConfig, $key);
			return $postConfig[$key];
		} else {
			if (isset($postConfig[$key])) {
				return $postConfig[$key];
			} else {
				return null;
			}
		}
	} else {
		return $postConfig;
	}
}

function readBlogPostConfig() {
	setBlogPostConfig(json_decode(file_get_contents('content/blog/' . getBlogPostId() . '/config.json'), TRUE));
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
// - author

function getBlogPostAuthor() {
	return getBlogPostConfig('author', false);
}

function hasBlogPostAuthor() {
	return getBlogPostAuthor() !== null;
}

function printBlogPostAuthor() {
	if (hasBlogPostAuthor()) {
		echo getBlogPostAuthor();
	} else {
		printAuthorName();
	}
}

//
// blog post config
// - author-email

function getBlogPostAuthorEmail() {
	return getBlogPostConfig('author-email', false);
}

function hasBlogPostAuthorEmail() {
	return getBlogPostAuthorEmail() !== null;
}

function printBlogPostAuthorEmail() {
	if (hasBlogPostAuthorEmail()) {
		echo getGravatarImg(getBlogPostAuthorEmail());
	} else {
		if (hasBlogPostAuthor()) {
			echo getGravatarImg('');
		} else {
			echo 'config/blog-author.jpg';
		}
	}
}

//
// blog post config
// - author-website

function getBlogPostAuthorWebsite() {
	return getBlogPostConfig('author-website', false);
}

function hasBlogPostAuthorWebsite() {
	return getBlogPostAuthorWebsite() !== null;
}

function printBlogPostAuthorWebsite() {
	if (hasBlogPostAuthorWebsite()) {
		echo getBlogPostAuthorWebsite();
	} else {
		if (hasBlogPostAuthor()) {
			echo '';
		} else {
			echo getAuthorWebsite();
		}
	}
}

//
// blog post config
// - keywords

function getBlogPostKeywords() {
	return getBlogPostConfig('keywords', false);
}

function hasBlogPostKeywords() {
	return getBlogPostResources() !== null;
}

function printBlogPostKeywords($prefix = '', $sufix = '') {
	if (hasBlogPostKeywords()) {
		foreach (getBlogPostKeywords() as $keyword) {
			echo $prefix . $keyword . $sufix;
		}
	}
}

//
// blog post config
// - description

function getBlogPostDescription() {
	return getBlogPostConfig('description', false);
}

// function hasBlogPostDescription() {d

function hasBlogPostDescription() {
	return getBlogPostDescription() !== null;
}

function printBlogPostDescription() {
	if (hasBlogPostDescription()) {
		echo getBlogPostDescription();
	}
}

//
// blog post config
// - resources

function getBlogPostResources() {
	return getBlogPostConfig('resources', false);
}

function hasBlogPostResources() {
	return getBlogPostResources() !== null;
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

function printBlogPostContent() {
	
	$blogPostContentBuffer = getBlogPostContent();
	
	$blogPostContentBuffer = str_replace('="images/', '="content/blog/' . getBlogPostId() . '/images/', $blogPostContentBuffer);
	
	$blogPostContentBuffer = str_replace(
			array('<pre>' . "\r\n",
					'<pre>' . "\r",
					'<pre>' . "\n",
					'<pre>' . "\n\r"),
			'<pre>',
			$blogPostContentBuffer);
	
	if (!isBlogFeed() && function_exists('updateBlogPostContent')) {
		$blogPostContentBuffer = updateBlogPostContent($blogPostContentBuffer);
	}
	
	echo $blogPostContentBuffer;
}

function readBlogPostContent($useExcerpt = false) {
	if ($useExcerpt) {
		setBlogPostContent(file_get_contents('content/blog/' . getBlogPostId() . '/excerpt.html'));
	} else {
		setBlogPostContent(file_get_contents('content/blog/' . getBlogPostId() . '/content.html'));
	}
}

function getBlogPostFolders() {
	return array_diff(scandir('content/blog/', 1), array(".", ".."));
}

//
// search
// - query

global $searchQuery;

function setSearchQuery($searchQueryNew) {
	global $searchQuery;
	$searchQuery = $searchQueryNew;
}

function getSearchQuery() {
	global $searchQuery;
	return $searchQuery;
}

function printSearchQuery() {
	echo getSearchQuery();
}

//
// search
// - results

global $searchResults;

function setSearchResults($searchResultsNew) {
	global $searchResults;
	$searchResults = $searchResultsNew;
}

function getSearchResults() {
	global $searchResults;
	return $searchResults;
}

function printSearchResults() {
	
	$searchResultsBuffer = getSearchResults();
	
	if (function_exists('updateSearchResults')) {
		$searchResultsBuffer = updateSearchResults($searchResultsBuffer);
	}
	
	echo $searchResultsBuffer;
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
			printBlogPostAuthor();
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

function checkIfIsSet($param, $index = null) {
	if (isset($index)) {
		if (!isset($param[$index])) {
			throw new Exception('variable not set or NULL');
		}
	} else {
		if (!isset($param)) {
			throw new Exception('variable not set or NULL');
		}
	}
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
