<?php
header('Content-Type: application/xml; charset=UTF-8');

include '__include.php';

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

foreach (array_diff(scandir('content/blog/', 1), array('.', '..')) as $file) {
	
	$postId = basename($file);
	$postConfig  = json_decode(readContentFile('blog/' . $postId . '/config.json'), TRUE);
	
	echo '	<url>' . PHP_EOL;
	
	echo '		<loc>';
	echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $postId;
	echo '</loc>';
	
	echo PHP_EOL;
	
	echo '		<lastmod>';
	echo date('c', strtotime($postConfig['date']));
	echo '</lastmod>' . PHP_EOL;
	
	echo '	</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>