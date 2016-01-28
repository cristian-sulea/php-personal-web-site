<?php
include '__include.php';

setContentTypeHTML();
setIsIndex();

readIndexExperience();
readIndexSkills();
readIndexLanguages();

includeThemeFile('page-prefix.php');
includeThemeFile('index-experience.php');
includeThemeFile('index-skills.php');
includeThemeFile('index-languages.php');
includeThemeFile('page-suffix.php');

?>