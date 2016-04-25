<?php

//
// default settings

$DEFAULT_THEME = "_default";

$BLOG_SEARCH_PARAM = 's';

$BLOG_POST_ID_PARAM = 'p';
$BLOG_POST_DATE_FORMAT = "F j, Y";

$GOOGLE_ANALYTICS_TRACKING_CODE = <<<EOT
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '%{TRACKING_ID}', 'auto');
  ga('send', 'pageview');
</script>
EOT;
$GOOGLE_ANALYTICS_TRACKING_ID = null;

//
// config|settings include

include 'config/settings.php';

includeThemeFileIfExists('_include-theme.php');

//
// some updates after include

setMenuBlog(getBlogTitle());

//
// config|settings getters and setters

function setAuthorName($name) {
	global $AUTHOR_NAME;
	$AUTHOR_NAME = htmlspecialchars($name);
}
function getAuthorName() {
	global $AUTHOR_NAME;
	return $AUTHOR_NAME;
}
function printAuthorName() {
	echo getAuthorName();
}

function setAuthorTitle($title) {
	global $AUTHOR_TITLE;
	$AUTHOR_TITLE = htmlspecialchars($title);
}
function getAuthorTitle() {
	global $AUTHOR_TITLE;
	return $AUTHOR_TITLE;
}
function printAuthorTitle() {
	echo getAuthorTitle();
}

function setAuthorDescription($description) {
	global $AUTHOR_DESCRIPTION;
	$AUTHOR_DESCRIPTION = htmlspecialchars($description);
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

function setAuthorKeywords($keywords) {
	global $AUTHOR_KEYWORDS;
	$AUTHOR_KEYWORDS = htmlspecialchars($keywords);
}
function printAuthorKeywords($prefix = '', $sufix = '') {
	global $AUTHOR_KEYWORDS;
	echo $prefix . $AUTHOR_KEYWORDS . $sufix;
}

function setAuthorProfileLinkedIn($user) {
	global $AUTHOR_PROFILES;
	$AUTHOR_PROFILES['LinkedIn'] = 'http://www.linkedin.com/in/' . $user;
}
function setAuthorProfileGooglePlus($user) {
	global $AUTHOR_PROFILES;
	$AUTHOR_PROFILES['Google+'] = 'http://plus.google.com/' . $user;
}
function setAuthorProfileTwitter($user) {
	global $AUTHOR_PROFILES;
	$AUTHOR_PROFILES['Twitter'] = 'http://twitter.com/' . $user;
}
function setAuthorProfileGitHub($user) {
	global $AUTHOR_PROFILES;
	$AUTHOR_PROFILES['GitHub'] = 'http://github.com/' . $user;
}
function setAuthorProfileSourceForge($user) {
	global $AUTHOR_PROFILES;
	$AUTHOR_PROFILES['SourceForge'] = 'http://sourceforge.net/u/' . $user . '/profile/';
}

function getAuthorProfiles() {
	global $AUTHOR_PROFILES;
	return $AUTHOR_PROFILES;
}

function hasAuthorProfiles() {
	return count(getAuthorProfiles()) > 0;
}

function printAuthorProfiles() {
	if (hasAuthorProfiles()) {
		if (!includeThemeFileIfExists('author-profiles.php')) {
			includeDefaultThemeFileIfExists('author-profiles.php');
		}
	}
}

function setBlogTitle($title) {
	global $BLOG_TITLE;
	$BLOG_TITLE = htmlspecialchars($title);
}
function getBlogTitle() {
	global $BLOG_TITLE;
	return $BLOG_TITLE;
}
function printBlogTitle() {
	echo getBlogTitle();
}

function setBlogDescription($description) {
	global $BLOG_DESCRIPTION;
	$BLOG_DESCRIPTION = htmlspecialchars($description);
}
function getBlogDescription() {
	global $BLOG_DESCRIPTION;
	return $BLOG_DESCRIPTION;
}
function printBlogDescription() {
	echo getBlogDescription();
}

function setBlogKeywords($keywords) {
	global $BLOG_KEYWORDS;
	$BLOG_KEYWORDS = htmlspecialchars($keywords);
}
function getBlogKeywords() {
	global $BLOG_KEYWORDS;
	return $BLOG_KEYWORDS;
}
function printBlogKeywords($prefix = '', $sufix = '') {
	echo $prefix . getBlogKeywords() . $sufix;
}

function setMenuBlog($title) {
	global $MENU;
	$MENU['blog.php'] = $title;
}

function getMenu() {
	global $MENU;
	return $MENU;
}
function printMenuItems($ulClass=null) {
	
	if (function_exists('theme_printMenuItems')) {
		theme_printMenuItems($ulClass);
	}
	
	else {
		if (empty($ulClass)) {
			echo '<ul>';
		} else {
			echo '<ul class="' . $ulClass . '">';
		}
		echo PHP_EOL;
		
		foreach (getMenu() as $link => $title ) {
			echo '	<li><a href="' . $link . '">' . $title . '</a></li>' . PHP_EOL;
		}
		
		echo '</ul>';
	}
}

function setGoogleAnalyticsTrackingId($id) {
	global $GOOGLE_ANALYTICS_TRACKING_ID;
	$GOOGLE_ANALYTICS_TRACKING_ID = $id;
}
function printGoogleAnalyticsTrackingCode() {
	global $GOOGLE_ANALYTICS_TRACKING_CODE;
	global $GOOGLE_ANALYTICS_TRACKING_ID;
	if (isset($GOOGLE_ANALYTICS_TRACKING_ID)) {
		$buffer = $GOOGLE_ANALYTICS_TRACKING_CODE;
		echo str_replace('%{TRACKING_ID}', $GOOGLE_ANALYTICS_TRACKING_ID, $GOOGLE_ANALYTICS_TRACKING_CODE);
	}
}

function getLogo($folder, $size) {

	$logo = 'config/' . $folder . '/logo-' . $size . '.png';
	if (file_exists($logo)) {
		return $logo;
	}

	$logo = 'config/' . $folder . '/logo-' . $size . '.jpg';
	if (file_exists($logo)) {
		return $logo;
	}

	$logo = 'config/' . $folder . '/logo-696.png';
	if (file_exists($logo)) {
		return $logo;
	}

	$logo = 'config/' . $folder . '/logo-696.jpg';
	if (file_exists($logo)) {
		return $logo;
	}

	throwMissingImageException($folder . ' logo');
}

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
	setContentType('application/xml');
}

//
// themes files

function setTheme($theme) {
	global $THEME;
	global $DEFAULT_THEME;
	if (isset($theme)) {
		$THEME = $theme;
	} else {
		$THEME = $DEFAULT_THEME;
	}
}
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
		return true;
	} else {
		return false;
	}
}

function getDefaultThemeFile($file) {
	global $DEFAULT_THEME;
	return "themes/" . $DEFAULT_THEME . "/" . $file;
}
function printDefaultThemeFile($file) {
	echo getDefaultThemeFile($file);
}
function includeDefaultThemeFile($file) {
	include getDefaultThemeFile($file);
}
function includeDefaultThemeFileIfExists($file) {
	$file = getDefaultThemeFile($file);
	if (file_exists($file)) {
		include $file;
		return true;
	} else {
		return false;
	}
}
function includeThemeHtmlPrefix() {
	include '_theme-html-prefix.php';
}
function includeThemeHtmlSuffix() {
	include '_theme-html-suffix.php';
}

//
// index

function getIndexLink() {
	return 'index.php';
}

function printIndexLink() {
	echo getIndexLink();
}

//
// index
// - icon

function getIndexIcon() {
	return 'config/index/icon.png';
}

//
// index
// - logo

function getIndexLogo($size) {
	return getLogo('index', $size);
}

function printIndexLogo($size) {
	echo getIndexLogo($size);
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
function printBlogLink() {
	echo getBlogLink();
}

//
// blog
// - icon

function getBlogIcon() {
	return 'config/blog/icon.png';
}

//
// blog
// - logo

function getBlogLogo($size) {
	return getLogo('blog', $size);
}

function printBlogLogo($size) {
	echo getBlogLogo($size);
}

//
// blog
// - search

function getBlogSearchParam() {
	global $BLOG_SEARCH_PARAM;
	return $BLOG_SEARCH_PARAM;
}
function printBlogSearchParam() {
	echo getBlogSearchParam();
}

global $blogSearchQuery;

function setBlogSearchQuery($blogSearchQueryNew) {
	global $blogSearchQuery;
	$blogSearchQuery = $blogSearchQueryNew;
}
function getBlogSearchQuery() {
	global $blogSearchQuery;
	//checkIfIsSet($blogSearchQuery);
	return $blogSearchQuery;
}
function printBlogSearchQuery() {
	echo getBlogSearchQuery();
}

global $blogSearchResult;

function setBlogSearchResult($blogSearchResultNew) {
	global $blogSearchResult;
	$blogSearchResult = $blogSearchResultNew;
}
function getBlogSearchResult() {
	global $blogSearchResult;
	checkIfIsSet($blogSearchResult);
	return $blogSearchResult;
}
function printBlogSearchResult() {
	echo getBlogSearchResult();
}

//
// blog post ID

function getBlogPostIdParam() {
	global $BLOG_POST_ID_PARAM;
	return $BLOG_POST_ID_PARAM;
}

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

function getBlogPostDateFormat() {
	global $BLOG_POST_DATE_FORMAT;
	return $BLOG_POST_DATE_FORMAT;
}

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

function getBlogPostAuthorImage($size) {
	
	$size = sprintf("%03d", $size);
	
	$author = getBlogPostConfig('author', false);
	
	if ($author === null) {
		
		$image = 'config/blog/author-' . $size . '.png';
		if (file_exists($image)) {
			return $image;
		}
		
		$image = 'config/blog/author-' . $size . '.jpg';
		if (file_exists($image)) {
			return $image;
		}
		
		$image = 'config/blog/author.png';
		if (file_exists($image)) {
			return $image;
		}
		
		$image = 'config/blog/author.jpg';
		if (file_exists($image)) {
			return $image;
		}
		
		throwMissingImageException('author image');
	}
	
	$email = getBlogPostConfig('author-email', false);
	
	if ($email === null) {
		return getGravatarImg(null, $size);
	}
	
	return getGravatarImg($email, $size);
}

function printBlogPostAuthorImage($size) {
	echo getBlogPostAuthorImage($size);
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
	return getBlogPostConfig('keywords');
}

function printBlogPostKeywords() {
	
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

//
// blog post config
// - description

function getBlogPostDescription() {
	return getBlogPostConfig('description');
}

function printBlogPostDescription() {
	echo getBlogPostDescription();
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
	echo '<ul>' . PHP_EOL;
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
	
	if (!isset($blogPostContentBuffer)) {
		throw new LogicException('blog post content is not read');
	}
	
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

function readBlogPostContent() {
	setBlogPostContent(file_get_contents('content/blog/' . getBlogPostId() . '/content.html'));
}

function getBlogPostFolders() {
	return array_diff(scandir('content/blog/', 1), array(".", ".."));
}

//
// blog post share
// - on Twiter

function printBlogPostShareOnTwiterLink() {
	
	$link = 'https://twitter.com/intent/tweet';
	$link .= '?text=' . urlencode(getBlogPostTitle());
	$link .= '&url='  . urlencode(getAbsoluteLink(getBlogPostLink()));
	
	echo $link;
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
	return 'Search: ' . getBlogSearchQuery() . ' | ' . getBlogTitle();
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
	return getBlogTitle() . ' - ' . getBlogDescription();
}
function getBlogPostHtmlDescription() {
	return getBlogPostDescription();
}
function getBlogSearchHtmlDescription() {
	return 'Search: ' . getBlogSearchQuery() . ' | ' . getBlogHtmlDescription();
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
		
		else if (isBlogSearch()) {
			printBlogKeywords('', ', ');
			printBlogSearchQuery();
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
		echo getIndexIcon();
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

function getGravatarImg($email, $size) {
	$url = 'http://www.gravatar.com/avatar/';
	if ($email != null) {
		$url .= md5(strtolower(trim($email)));
	}
	$url .= '?d=mm';
	$url .= '&size=' . $size;
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
	},
	"author": {
		"@type": "Person",
		"name": "%author.name%",
		"url": "%author.url%"
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
	},
	"author": {
		"@type": "Person",
		"name": "%author.name%",
		"url": "%author.url%"
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

$GOOGLE_STRUCTURED_DATA_PERSON = <<<EOT

<script type="application/ld+json">
{
	"@context" : "http://schema.org",
	"@type" : "Person",
	"name" : "%name%",
	"url" : "%url%",
	"sameAs" : [%sameas%
	]
}
</script>

EOT;

function printGoogleStructuredData() {
	
	if (isBlogSearch() || isBlogFeed()) {
		return;
	}
	
	global $GOOGLE_STRUCTURED_DATA_WEBSITE;
	
	global $GOOGLE_STRUCTURED_DATA_BLOG;
	
	global $GOOGLE_STRUCTURED_DATA_BREADCRUMB_LIST;
	global $GOOGLE_STRUCTURED_DATA_BLOG_POSTING;
	
	global $GOOGLE_STRUCTURED_DATA_PERSON;
	
	$buffer = '';
	
	if (isIndex()) {
		
		$bufferWebSite = $GOOGLE_STRUCTURED_DATA_WEBSITE;
		
		$bufferWebSite = str_replace("%name%", getIndexHtmlTitle(), $bufferWebSite);
		$bufferWebSite = str_replace("%url%", getAbsoluteLink(), $bufferWebSite);
		$bufferWebSite = str_replace("%target%", getAbsoluteLink(getBlogLink() . '?' . getBlogSearchParam()), $bufferWebSite);
		$bufferWebSite = str_replace("%author.name%", getAuthorName(), $bufferWebSite);
		$bufferWebSite = str_replace("%author.url%", getAbsoluteLink(), $bufferWebSite);
		
		$buffer .= $bufferWebSite;
	}
	
	else if (isBlog()) {
		
		if (isBlogPost()) {
			
			//
			// BreadcrumbList
			
			$bufferBreadcrumbList = $GOOGLE_STRUCTURED_DATA_BREADCRUMB_LIST;
			
			$bufferBreadcrumbList = str_replace("%id1%", getAbsoluteLink(getBlogLink()), $bufferBreadcrumbList);
			$bufferBreadcrumbList = str_replace("%name1%", getBlogHtmlTitle(), $bufferBreadcrumbList);
			
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
			
			$bufferBlogPosting = str_replace('%publisher.name%', getBlogHtmlTitle(), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.url%', getAbsoluteLink(getBlogLink()), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.url%', getAbsoluteLink(getBlogLogo('060')), $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.width%', '60', $bufferBlogPosting);
			$bufferBlogPosting = str_replace('%publisher.logo.height%', '60', $bufferBlogPosting);
			
			$buffer .= $bufferBlogPosting;
		}
		
		else if (isBlogSearch()) {
			// do nothing (at the moment)
		}
		
		else if (isBlogFeed()) {
			// do nothing (at the moment)
		}
		
		else {
			
			$bufferBlog = $GOOGLE_STRUCTURED_DATA_BLOG;
			
			$bufferBlog = str_replace("%name%", getBlogHtmlTitle(), $bufferBlog);
			$bufferBlog = str_replace("%url%", getAbsoluteLink(getBlogLink()), $bufferBlog);
			$bufferBlog = str_replace("%target%", getAbsoluteLink(getBlogLink(). '?' . getBlogSearchParam()), $bufferBlog);
			$bufferBlog = str_replace("%author.name%", getAuthorName(), $bufferBlog);
			$bufferBlog = str_replace("%author.url%", getAbsoluteLink(), $bufferBlog);
			
			$buffer .= $bufferBlog;
		}
	}
	
	$bufferPerson = $GOOGLE_STRUCTURED_DATA_PERSON;
	$bufferPerson = str_replace("%name%", getAuthorName(), $bufferPerson);
	$bufferPerson = str_replace("%url%", getAbsoluteLink(), $bufferPerson);
	
	$bufferSameAs = '';
	if (hasAuthorProfiles()) {
		foreach (getAuthorProfiles() as  $title => $link ) {
			$bufferSameAs .= PHP_EOL . '		"' . $link . '",';
		}
	}
	$bufferSameAs = substr($bufferSameAs, 0, strlen($bufferSameAs) - 1);
	
	$bufferPerson = str_replace("%sameas%", $bufferSameAs, $bufferPerson);
	
	$buffer .= $bufferPerson;
	
	echo $buffer;
}

?>
