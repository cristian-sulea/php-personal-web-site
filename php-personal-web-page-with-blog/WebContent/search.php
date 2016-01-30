<?php
include '_include.php';

setContentTypeHTML();
setIsBlog();

if (isset($_GET[getSearchQueryParam()])) {
	setSearchQuery($_GET[getSearchQueryParam()]);
}

if (!getSearchQuery()) {
	redirect('blog.php');
}

$searchResultsGoogle = <<<EOT

<script>
  (function() {

	window.__gcse = {
      callback: myCallback
    }
	function myCallback() {
		var loading = document.getElementById("search-results-loading");
		loading.parentNode.removeChild(loading);
	}

    var cx = '008197242257401797086:73803bll01y';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:searchresults-only></gcse:searchresults-only>

EOT;

setSearchResults($searchResultsGoogle);

includeThemeFile("page-prefix.php");
includeThemeFile("search-results.php");
includeThemeFile("page-suffix.php");
?>