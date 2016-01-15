<?php

include "__include.php";

$isBlog = true;

include "_include-blog.php";

includeThemeFile("page-prefix.php");

?>

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

<script type="text/javascript">
<!--

// to defer the loading of stylesheets
// just add it right before the </body> tag
// and before any javaScript file inclusion (for performance)  
function loadStyleSheet(src){
    if (document.createStyleSheet) document.createStyleSheet(src);
    else {
        var stylesheet = document.createElement('link');
        stylesheet.href = src;
        stylesheet.rel = 'stylesheet';
        stylesheet.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(stylesheet);
    }
}

loadStyleSheet("search.css");

//-->
</script>

<?php
	includeThemeFile("page-suffix.php");
?>
