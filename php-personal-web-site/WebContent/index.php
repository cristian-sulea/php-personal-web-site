<?php
include '_include.php';

setContentTypeHTML();
setIsIndex();

readIndexExperience();
readIndexSkills();
readIndexLanguages();

includeThemeHtmlPrefix();
includeThemeFile('index-experience.php');
includeThemeFile('index-skills.php');
includeThemeFile('index-languages.php');
includeThemeHtmlSuffix();

?>