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

echo '<link>' . 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']) . '</link>' . PHP_EOL;
echo '<atom:link href="' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '" rel="self" type="application/rss+xml" />' . PHP_EOL;

echo PHP_EOL;

foreach (array_diff(scandir('content/blog/', 1), array('.', '..')) as $file) {
	
	$postId = basename($file);
	
	$postConfig  = json_decode(readContentFile('blog/' . $postId . '/config.json'), TRUE);
	$blogPostContent = readContentFile('blog/' . $postId . '/excerpt.html');
	$postLink = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('feed.php', 'blog.php', $_SERVER['PHP_SELF']) . '?' . $postId;
	
	echo '<item>' . PHP_EOL;
	
	echo '	<title>';
	printPostTitle();
	echo '</title>' . PHP_EOL;
	
	echo '	<link>';
	echo $postLink;
	echo '</link>' . PHP_EOL;
	echo '	<guid>';
	echo $postLink;
	echo '</guid>' . PHP_EOL;
	
	echo '	<pubDate>';
	echo date('D, d M Y H:i:s O', strtotime($postConfig['date']));
	echo '</pubDate>' . PHP_EOL;
	
	echo '	<dc:creator><![CDATA[';
	printPostAuthor();
	echo ']]></dc:creator>' . PHP_EOL;
	
	echo '	<description><![CDATA[';
	printBlogPostContent();
	echo '<br>';
	echo '<a href="';
	echo $postLink;
	echo '">Continue Reading</a>';
	echo ']]></description>' . PHP_EOL;
	
	echo '</item>' . PHP_EOL;
}

echo PHP_EOL;
echo '</channel>' . PHP_EOL;
echo '</rss>' . PHP_EOL;

?>