<?php

//
// default settings

$THEME = "_default";

$AUTHOR_NAME        = "";
$AUTHOR_TITLE       = "";
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

$SEARCH_QUERY_PARAM = 'q';

$MENU = array(
		array("Blog", "blog.php"),
		// 	array("Photos", "photos.php")
);

$GOOGLE_ANALYTICS_TRACKING_CODE = <<<EOT
EOT;

function getAuthorName() {
	global $AUTHOR_NAME;
	return $AUTHOR_NAME;
}

function printAuthorName() {
	echo getAuthorName();
}

function getAuthorTitle() {
	global $AUTHOR_TITLE;
	return $AUTHOR_TITLE;
}

function printAuthorTitle() {
	echo getAuthorTitle();
}

function getAuthorDescription() {
	global $AUTHOR_DESCRIPTION;
	return $AUTHOR_DESCRIPTION;
}

function printAuthorDescription() {
	echo getAuthorDescription();
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

function getBlogTitle() {
	global $BLOG_TITLE;
	return $BLOG_TITLE;
}
function printBlogTitle() {
	echo getBlogTitle();
}

function getBlogDescription() {
	global $BLOG_DESCRIPTION;
	return $BLOG_DESCRIPTION;
}
function printBlogDescription() {
	echo getBlogDescription();
}

function getBlogKeywords() {
	global $BLOG_KEYWORDS;
	return $BLOG_KEYWORDS;
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
function printMenuItems() {
	foreach (getMenu() as $menu) {
		theme_printMenuItem($menu[0], $menu[1]);
	}
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

$isIndex      = false;
$isBlog       = false;
$isBlogPost   = false;
$isBlogFeed   = false;
$isBlogSearch = false;

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
function isBlogPost() {
	global $isBlogPost;
	return $isBlogPost;
}
function setIsBlogPost() {
	global $isBlogPost;
	$isBlogPost = true;
}
function isBlogFeed() {
	global $isBlogFeed;
	return $isBlogFeed;
}
function setIsBlogFeed() {
	global $isBlogFeed;
	$isBlogFeed = true;
}
function isBlogSearch() {
	global $isBlogSearch;
	return $isBlogSearch;
}
function setIsBlogSearch() {
	global $isBlogSearch;
	$isBlogSearch = true;
}

//
// page content type

function setContentType($contentType) {
	header('Content-Type: ' . $contentType . '; charset=UTF-8');
}
function setContentTypeHTML() {
	setContentType('text/html');
}
function setContentTypeTEXT() {
	setContentType('text/plain');
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

function getBlogLink() {
	return 'blog.php';
}

//
// blog
// - icon

function getBlogIcon() {
	return 'config/content/blog/icon.png';
}

//
// blog
// - logo

function getBlogLogo($size) {
	
	$logo = 'config/content/blog/logo-' . $size . '.png';
	if (file_exists($logo)) {
		return $logo;
	}
	
	$logo = 'config/content/blog/logo-' . $size . '.jpg';
	if (file_exists($logo)) {
		return $logo;
	}
	
	$logo = 'config/content/blog/logo-696.png';
	if (file_exists($logo)) {
		return $logo;
	}
	
	$logo = 'config/content/blog/logo-696.jpg';
	if (file_exists($logo)) {
		return $logo;
	}
	
	throwMissingImageException('blog logo');
}

function printBlogLogo($size) {
	echo getBlogLogo($size);
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
	return getBlogLink() . '?' . getBlogPostIdParam() . '=' . getBlogPostId();
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

function getBlogPostDateModified($format = null) {
	
	$dateModified = getBlogPostConfig('date-modified', false);
	
	if ($dateModified !== null) {
		if (isset($format)) {
			return date($format, strtotime($dateModified));
		} else {
			return date(getBlogPostDateFormat(), strtotime($dateModified));
		}
	}
	
	else {
		return getBlogPostDate($format);
	}
}

//
// blog post config
// - author

function getBlogPostAuthor() {
	
	$author = getBlogPostConfig('author', false);
	
	if ($author === null) {
		return getAuthorName();
	}
	
	return $author;
}

function hasBlogPostAuthor() {
	return getBlogPostConfig('author', false) !== null;
}

function printBlogPostAuthor() {
	echo getBlogPostAuthor();
}

//
// blog post config
// - author-image

function getBlogPostAuthorImage() {
	
	$author = getBlogPostConfig('author', false);
	
	if ($author === null) {
		return 'config/blog-author.jpg';
	}
	
	$email = getBlogPostConfig('author-email', false);
	
	if ($email === null) {
		return getGravatarImg('');
	}
	
	return getGravatarImg($email);
}

function printBlogPostAuthorImage() {
	echo getBlogPostAuthorImage();
}

//
// blog post config
// - author-website

function getBlogPostAuthorWebsite() {

	$author = getBlogPostConfig('author', false);
	
	if ($author === null) {
		return getAbsoluteLink();
	}
	
	$website = getBlogPostConfig('author-website', false);
	
	if ($website === null) {
		return '';
	}
	
	return $website;
}

function printBlogPostAuthorWebsite() {
	echo getBlogPostAuthorWebsite();
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

function printBlogPostKeywords() {
	if (hasBlogPostKeywords()) {
		$isFirst = true;
		foreach (getBlogPostKeywords() as $keyword) {
			
			if ($isFirst) {
				$isFirst = false;
			} else {
				echo ', ';
			}
			
			echo $keyword;
		}
	}
}

function printBlogPostKeywordsOld($prefix = '', $sufix = '') {
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
		echo '<li>';
		if (is_array($resource)) {
			echo '<a href="' . $resource[1] . '">' . $resource[0] . '</a>';
		} else {
			echo $resource;
		}
		echo '</li>';
		echo PHP_EOL;
	}
	echo '</ul>';
}

//
// blog post image

function getBlogPostImage($size = '696') {
	
	$image = 'content/blog/' . getBlogPostId() . '/image-' . $size . '.png';
	if (file_exists($image)) {
		return $image;
	}
	
	$image = 'content/blog/' . getBlogPostId() . '/image-' . $size . '.jpg';
	if (file_exists($image)) {
		return $image;
	}
	
	foreach (getBlogPostKeywords() as $keyword) {
		
		$keyword = preg_replace('/\s+/', '-', $keyword);
		
		$image = 'config/content/blog/images/' . $keyword . '-' . $size . '.png';
		if (file_exists($image)) {
			return $image;
		}
		
		$image = 'config/content/blog/images/' . $keyword . '-' . $size . '.jpg';
		if (file_exists($image)) {
			return $image;
		}
	}
	
	return getBlogLogo($size);
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
// HTML components

function getIndexHtmlTitle() {
	return getAuthorName() . ' - ' . getAuthorTitle();
}
function getBlogHtmlTitle() {
	return getBlogTitle() . ' | ' . getAuthorName();
}
function getBlogPostHtmlTitle() {
	return getBlogPostTitle() . ' | ' . getAuthorName();
}
function getBlogSearchHtmlTitle() {
	return 'Search: ' . getSearchQuery() . ' | ' . getBlogTitle();
}

function printHtmlHeadTitle() {
	
	if (isIndex()) {
		echo getIndexHtmlTitle();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			echo getBlogPostHtmlTitle();
		}
		
		else if (isBlogSearch()) {
			echo getBlogSearchHtmlTitle();
		}
		
		else {
			echo getBlogHtmlTitle();
		}
	}
	
	else {
		throwUnknownPageTypeException();
	}
}

function getIndexHtmlDescription() {
	return getAuthorDescription();
}
function getBlogHtmlDescription() {
	return getBlogDescription();
}
function getBlogPostHtmlDescription() {
	if (hasBlogPostDescription()) {
		return getBlogPostDescription();
	} else {
		return getBlogPostTitle();
	}
}
function getBlogSearchHtmlDescription() {
	return 'Search: ' . getSearchQuery() . ' | ' . getBlogDescription();
}

function printHtmlHeadMetaDescription() {
	
	if (isIndex()) {
		echo getIndexHtmlDescription();
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			echo getBlogPostHtmlDescription();
		}
		
		else if (isBlogSearch()) {
			echo getBlogSearchHtmlDescription();
		}
		
		else {
			echo getBlogHtmlDescription();
		}
	}
	
	else {
		throwUnknownPageTypeException();
	}
}

function printHtmlHeadMetaKeywords() {
	
	if (isIndex()) {
		printAuthorKeywords();
	}
	
	else if (isBlog()) {
	
		if (isBlogPost()) {
			printBlogPostKeywords();
		}
	
		else {
			printAuthorKeywords();
			printBlogKeywords(', ', '');
		}
	}
	
	else {
		throwUnknownPageTypeException();
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
		throwUnknownPageTypeException();
	}
}

function printHtmlHeadLinkIcon() {
	
	if (isIndex()) {
		echo "config/index-icon.png";
	}
	
	else if (isBlog()) {
		echo getBlogIcon();
	}
	
	else {
		throwUnknownPageTypeException();
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

function getAbsoluteLink($page = null) {

	$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
	$host = $_SERVER ['HTTP_HOST'];
	$request = $_SERVER ['REQUEST_URI'];
	
	$link = $prefix . $host;
	
	if (strcmp('/', $request) !== 0) {
		
		$link .= $request;
		
		if (!endsWith($link, '/')) {
			$link = dirname($link);
		}
	}
	
	if ($page !== null) {
		
		if (!endsWith($link, '/')) {
			$link .= '/';
		}
		
		$link .= $page;
	}
	
	return $link;
}

function endsWith($string, $test) {
	$strlen = strlen($string);
	$testlen = strlen($test);
	if ($testlen > $strlen) return false;
	return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}

function throwUnknownPageTypeException() {
	throw new LogicException('unknown page type');
}
function throwMissingImageException($image) {
	throw new LogicException('missing image: ' . $image);
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

//
// google structured data

$GOOGLE_STRUCTURED_DATA_WEBSITE = <<<EOT

<script type="application/ld+json">
{
	"@context" : "http://schema.org",
	"@type" : "WebSite",
	"name" : "%name%",
	"url" : "%url%",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "%target%={search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>

EOT;

$GOOGLE_STRUCTURED_DATA_BLOG = <<<EOT

<script type="application/ld+json">
{
	"@context" : "http://schema.org",
	"@type" : "Blog",
	"name" : "%name%",
	"url" : "%url%",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "%target%={search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>

EOT;

$GOOGLE_STRUCTURED_DATA_BREADCRUMB_LIST = <<<EOT

<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "BreadcrumbList",
	"itemListElement": [{
		"@type": "ListItem",
		"position": 1,
		"item": {
			"@id": "%id1%",
			"name": "%name1%"
		}
	}]
}
</script>

EOT;

$GOOGLE_STRUCTURED_DATA_BLOG_POSTING = <<<EOT

<script type="application/ld+json">
{

	"@context": "http://schema.org",
	"@type": "BlogPosting",

	"mainEntityOfPage": {
		"@type": "WebPage",
		"@id":   "%mainEntityOfPage.id%"
	},

	"headline":    "%headline%",
	"description": "%description%",

	"datePublished": "%datePublished%",
	"dateModified":  "%dateModified%",

	"image": {
		"@type": "ImageObject",
		"url":   "%image.url%",
		"width":  %image.width%,
		"height": %image.height%
	},

	"author": {
		"@type": "Person",
		"name":  "%author.name%",
		"url":   "%author.url%"
	},

	"publisher": {
		"@type": "Organization",
		"name":  "%publisher.name%",
		"url":   "%publisher.url%",
		"logo": {
			"@type": "ImageObject",
			"url":   "%publisher.logo.url%",
			"width":  %publisher.logo.width%,
			"height": %publisher.logo.height%
		}
	}

}
</script>

EOT;

function printGoogleStructuredData() {
	
	global $GOOGLE_STRUCTURED_DATA_WEBSITE;
	global $GOOGLE_STRUCTURED_DATA_BLOG;
	global $GOOGLE_STRUCTURED_DATA_BREADCRUMB_LIST;
	global $GOOGLE_STRUCTURED_DATA_BLOG_POSTING;
	
	$buffer = '';
	
	if (isIndex()) {
		
		$bufferWebSite = $GOOGLE_STRUCTURED_DATA_WEBSITE;
		
		$bufferWebSite = str_replace("%name%", getIndexHtmlTitle(), $bufferWebSite);
		$bufferWebSite = str_replace("%url%", getAbsoluteLink(), $bufferWebSite);
		$bufferWebSite = str_replace("%target%", getAbsoluteLink('search.php?' . getSearchQueryParam()), $bufferWebSite);
		
		$buffer .= $bufferWebSite;
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			
			//
			// BreadcrumbList
			
			$bufferBreadcrumbList = $GOOGLE_STRUCTURED_DATA_BREADCRUMB_LIST;
			
			$bufferBreadcrumbList = str_replace("%id1%", getAbsoluteLink(getBlogLink()), $bufferBreadcrumbList);
			$bufferBreadcrumbList = str_replace("%name1%", getBlogTitle(), $bufferBreadcrumbList);
			
			$buffer .= $bufferBreadcrumbList;
			
			//
			// BlogPosting
			
			$bufferBlogPosting = $GOOGLE_STRUCTURED_DATA_BLOG_POSTING;
			
			$bufferBlogPosting = str_replace('%mainEntityOfPage.id%', getAbsoluteLink(getBlogPostLink()), $bufferBlogPosting);
			
			$bufferBlogPosting = str_replace('%headline%', getBlogPostTitle(), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%description%', getBlogPostDescription(), $bufferBlogPosting);
			
			$bufferBlogPosting = str_replace('%datePublished%', getBlogPostDate('c'), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%dateModified%', getBlogPostDateModified('c'), $bufferBlogPosting);
			
			$image = getAbsoluteLink(getBlogPostImage());
			$imageSize = getimagesize($image);
			$bufferBlogPosting = str_replace('%image.url%', $image, $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%image.width%', $imageSize[0], $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%image.height%', $imageSize[1], $bufferBlogPosting);
			
			$bufferBlogPosting = str_replace('%author.name%', getBlogPostAuthor(), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%author.url%', getBlogPostAuthorWebsite(), $bufferBlogPosting);
			
			$bufferBlogPosting = str_replace('%publisher.name%', getBlogTitle(), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.url%', getAbsoluteLink(getBlogLink()), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.url%', getAbsoluteLink(getBlogLogo('060')), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.width%', '60', $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.height%', '60', $bufferBlogPosting);
			
			$buffer .= $bufferBlogPosting;
		}
		
		else {
			
			$bufferBlog = $GOOGLE_STRUCTURED_DATA_BLOG;
			
			$bufferBlog = str_replace("%name%", getBlogHtmlTitle(), $bufferBlog);
			$bufferBlog = str_replace("%url%", getAbsoluteLink(getBlogLink()), $bufferBlog);
			$bufferBlog = str_replace("%target%", getAbsoluteLink('search.php?' . getSearchQueryParam()), $bufferBlog);
			
			$buffer .= $bufferBlog;
		}
	}
	
	echo $buffer;
}

?>
