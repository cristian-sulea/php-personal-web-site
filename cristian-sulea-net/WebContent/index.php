<?php
header('Content-Type: text/html; charset=UTF-8');

include "__include.php";

$isIndex = true;

include "_include-index.php";

includeThemeFile("page-prefix.php");
includeThemeFile("index-experience.php");
includeThemeFile("index-skills.php");
includeThemeFile("index-languages.php");
includeThemeFile("page-suffix.php");

?>