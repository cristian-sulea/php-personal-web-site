<?php
include '_include.php';

setContentTypeXML();

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">' . PHP_EOL;

echo '	<ShortName>'   . getBlogTitle()       . '</ShortName>'   . PHP_EOL;
echo '	<Description>' . getBlogDescription() . '</Description>' . PHP_EOL;

echo '	<Image width="16" height="16" type="image/png">' . getAbsoluteLink(getBlogIcon()) . '</Image>' . PHP_EOL;

echo '	<InputEncoding>UTF-8</InputEncoding>'   . PHP_EOL;
echo '	<OutputEncoding>UTF-8</OutputEncoding>' . PHP_EOL;

echo '	<Url type="text/html" template="' . getAbsoluteLink(getBlogLink()) . '?' . getBlogSearchParam() . '={searchTerms}"/>' . PHP_EOL;

echo '</OpenSearchDescription>' . PHP_EOL;

?>