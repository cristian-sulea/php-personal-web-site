<?php
include '_include.php';

setContentTypeXML();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink() . '</loc>' . PHP_EOL;
echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink('index.php') . '</loc>' . PHP_EOL;
echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

echo '	<url>' . PHP_EOL;
echo '		<loc>' . getAbsoluteLink('blog.php') . '</loc>' . PHP_EOL;
echo '		<lastmod>' . date('c', strtotime("now")) . '</lastmod>' . PHP_EOL;
echo '		<changefreq>daily</changefreq>' . PHP_EOL;
echo '	</url>' . PHP_EOL;

foreach (getBlogPostFolders() as $blogPostFolder) {
	
	setBlogPostId(basename($blogPostFolder));
	
	readBlogPostConfig();
	
	echo '	<url>' . PHP_EOL;
	echo '		<loc>' . getAbsoluteLink(getBlogPostLink()) . '</loc>' . PHP_EOL;
	echo '		<lastmod>' . getBlogPostDate('c') . '</lastmod>' . PHP_EOL;
	echo '	</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>