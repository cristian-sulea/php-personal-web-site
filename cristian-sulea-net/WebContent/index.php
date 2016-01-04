<?php

$THEME = 'themes/html5up-future-imperfect';

$post = file_get_contents('posts/post.html');

?>

<?php include($THEME . '/page-prefix.php');?>
<?php include($THEME . '/post.php');?>
<?php include($THEME . '/page-suffix.php');?>
