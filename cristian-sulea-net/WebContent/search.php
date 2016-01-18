<?php

include '__include.php';

$isBlog = true;

include '_include-blog.php';
include '_include-search.php';

$searchQuery = $_GET['q'];

$searchResults = <<<EOT

<script>
  (function() {
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

includeThemeFile("page-prefix.php");
includeThemeFile("search.php");
includeThemeFile("page-suffix.php");
?>