<?php
include '_include.php';

setContentTypeRSS();
setIsBlogFeed();

echo '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"' . PHP_EOL;
echo '	xmlns:atom="http://www.w3.org/2005/Atom"' . PHP_EOL;
echo '	xmlns:dc="http://purl.org/dc/elements/1.1/">' . PHP_EOL;

echo PHP_EOL;

echo '<channel>' . PHP_EOL;

echo PHP_EOL;

echo '<title>' . getBlogHtmlTitle() . '</title>' . PHP_EOL;
echo '<description>' . getBlogHtmlDescription() . '</description>' . PHP_EOL;
echo '<link>' . getAbsoluteLink(getBlogLink()) . '</link>' . PHP_EOL;
echo '<atom:link href="' . getAbsoluteLink('feed.php') . '" rel="self" type="application/rss+xml" />' . PHP_EOL;

echo PHP_EOL;

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	setBlogPostId(basename($blogPostFolder));
	readBlogPostConfig();
	
	$postLink = getAbsoluteLink(getBlogPostLink());
	
	echo '<item>' . PHP_EOL;
	
	echo '	<title>';
	printBlogPostTitle();
	echo '</title>' . PHP_EOL;
	
	echo '	<link>' . $postLink . '</link>' . PHP_EOL;
	echo '	<guid>' . $postLink . '</guid>' . PHP_EOL;
	
	echo '	<pubDate>';
	printBlogPostDate('D, d M Y H:i:s O');
	echo '</pubDate>' . PHP_EOL;
	
	echo '	<dc:creator><![CDATA[';
	printBlogPostAuthor();
	echo ']]></dc:creator>' . PHP_EOL;
	
	echo '	<description><![CDATA[';
	echo '<img src="' . getAbsoluteLink(getBlogPostImage('064')) . '" style="float: left; margin-right: 1em;" />';
	printBlogPostDescription();
	echo '<br><a href="' . $postLink . '">Continue Reading</a>]]></description>' . PHP_EOL;
	
	echo '</item>' . PHP_EOL;
}

echo PHP_EOL;
echo '</channel>' . PHP_EOL;
echo '</rss>' . PHP_EOL;

?>