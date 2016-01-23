<?php
include '__include.php';

setContentTypeHTML();
setIsIndex();

include '_include-index.php';

includeThemeFile('page-prefix.php');
includeThemeFile('index-experience.php');
includeThemeFile('index-skills.php');
includeThemeFile('index-languages.php');
includeThemeFile('page-suffix.php');

?>