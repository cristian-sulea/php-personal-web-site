<?php

include "_include.php";
$isIndex = true;

//
// content index

$personal = new DOMDocument();
$personal->loadXML(readContentFile("index/personal.xml"));

$experience = new DOMDocument();
$experience->loadXML(readContentFile("index/experience.xml"));

$skills = new DOMDocument();
$skills->loadXML(readContentFile("index/skills.xml"));

$languages = new DOMDocument();
$languages->loadXML(readContentFile("index/languages.xml"));

includeThemeFile("page-prefix.php");
includeThemeFile("index-experience.php");
includeThemeFile("index-skills.php");
includeThemeFile("index-languages.php");
includeThemeFile("page-suffix.php");

//
// functions

function printProfiles() {
	global $personal;
	
	foreach($personal->getElementsByTagName("profile") as $profile) {
		printProfile($profile->getAttribute("title"), $profile->getAttribute("link"));
	}
}

function printExperienceTitle() {
	global $experience;
	echo $experience->documentElement->getAttribute("title");
}
function printExperience() {
	global $experience;

	foreach($experience->getElementsByTagName('position') as $position) {

		$title = $position->getElementsByTagName("title")->item(0)->textContent;
		$company = $position->getElementsByTagName("company")->item(0)->textContent;
		$period = $position->getElementsByTagName("period")->item(0)->textContent;
		$location = $position->getElementsByTagName("location")->item(0)->textContent;

		$description = $position->getElementsByTagName("description");
		if ($description->length > 0) {
			$description = $description->item(0)->textContent;
		} else {
			$description = "";
		}

		printExperiencePosition($title, $company, $period, $location, $description);
	}
}

function printSkillsTitle() {
	global $skills;
	echo $skills->documentElement->getAttribute("title");
}
function printSkills() {
	global $skills;

	foreach($skills->getElementsByTagName('group') as $group) {

		$title = $group->getElementsByTagName("title")->item(0)->textContent;
		$description = $group->getElementsByTagName("description")->item(0)->textContent;

		printSkillsGroup($title, $description);
	}
}

function printLanguagesTitle() {
	global $languages;
	echo $languages->documentElement->getAttribute("title");
}

function printLanguages() {
	global $languages;

	foreach($languages->getElementsByTagName('language') as $language) {

		$name = $language->getElementsByTagName("name")->item(0)->textContent;
		$level = $language->getElementsByTagName("level")->item(0)->textContent;

		printLanguagesLanguage($name, $level);
	}
}

?>