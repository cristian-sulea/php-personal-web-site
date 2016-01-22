<?php
header('Content-Type: application/xml; charset=UTF-8');

include '__include.php';

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

foreach (array_diff(scandir('content/blog/', 1), array('.', '..')) as $file) {
	
	$postId = basename($file);
	$postConfig  = readBlogPostConfig($postId);
	
	echo '	<url>' . PHP_EOL;
	echo '		<loc>' . getAbsoluteLink(getBlogPostLink($postId)) . '</loc>' . PHP_EOL;
	echo '		<lastmod>' . date('c', strtotime($postConfig['date'])) . '</lastmod>' . PHP_EOL;
	echo '	</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>