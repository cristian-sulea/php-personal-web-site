<?php
include '_include.php';

setContentTypeXML();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink() . '/</loc>' . PHP_EOL;
// echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink(getIndexLink()) . '</loc>' . PHP_EOL;
// echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink(getBlogLink()) . '</loc>' . PHP_EOL;
// echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
// echo '		<changefreq>daily</changefreq>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	setBlogPostId(basename($blogPostFolder));
	readBlogPostConfig();
	
// 	$lastmodConfig = filemtime('content/blog/' . getBlogPostId() . '/config.json');
// 	$lastmodContent = filemtime('content/blog/' . getBlogPostId() . '/content.html');
// 	$lastmod = $lastmodConfig > $lastmodContent ? $lastmodConfig : $lastmodContent;
	
	echo '	<url>' . PHP_EOL;
	echo '		<loc>' . getAbsoluteLink(getBlogPostLink()) . '</loc>' . PHP_EOL;
// 	echo '		<lastmod>' . getBlogPostDate('c') . '</lastmod>' . PHP_EOL;
// 	echo '		<lastmod>' . date ('c', $lastmod) . '</lastmod>' . PHP_EOL;
// 	echo '		<lastmod>' . getBlogPostDateModified('c') . '</lastmod>' . PHP_EOL;
	echo '	</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>