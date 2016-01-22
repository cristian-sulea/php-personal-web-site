<?php
header('Content-Type: application/rss+xml; charset=UTF-8');

include '__include.php';

$isBlogFeed = true;

include '_include-blog.php';

echo '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"' . PHP_EOL;
echo '	xmlns:atom="http://www.w3.org/2005/Atom"' . PHP_EOL;
echo '	xmlns:dc="http://purl.org/dc/elements/1.1/">' . PHP_EOL;

echo PHP_EOL;

echo '<channel>' . PHP_EOL;

echo PHP_EOL;

echo '<title>' . $BLOG_TITLE . '</title>' . PHP_EOL;
echo '<description>' . $BLOG_DESCRIPTION . '</description>' . PHP_EOL;
echo '<link>' . getAbsoluteLink() . '</link>' . PHP_EOL;
echo '<atom:link href="' . getAbsoluteLink('feed.php') . '" rel="self" type="application/rss+xml" />' . PHP_EOL;

echo PHP_EOL;

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	$postId = basename($blogPostFolder);
	
	$postConfig = readBlogPostConfig($postId);
	$blogPostContent = readBlogPostExcerpt($postId);
	
	$postLink = getAbsoluteLink(getBlogPostLink($postId));
	
	echo '<item>' . PHP_EOL;
	
	echo '	<title>';
	printPostTitle();
	echo '</title>' . PHP_EOL;
	
	echo '	<link>' . $postLink . '</link>' . PHP_EOL;
	echo '	<guid>' . $postLink . '</guid>' . PHP_EOL;
	
	echo '	<pubDate>';
	printPostDate('D, d M Y H:i:s O');
	echo '</pubDate>' . PHP_EOL;
	
	echo '	<dc:creator><![CDATA[';
	printPostAuthor();
	echo ']]></dc:creator>' . PHP_EOL;
	
	echo '	<description><![CDATA[';
	printBlogPostContent();
	echo '<br><a href="' . $postLink . '">Continue Reading</a>]]></description>' . PHP_EOL;
	
	echo '</item>' . PHP_EOL;
}

echo PHP_EOL;
echo '</channel>' . PHP_EOL;
echo '</rss>' . PHP_EOL;

?>