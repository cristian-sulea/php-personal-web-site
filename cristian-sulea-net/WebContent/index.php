<?php

include('_include.php');
$isIndex = true;

//
// content index

include(getThemeFile("page-prefix.php"));

//
// content index experience

$experience = new DOMDocument();
$experience->loadXML(file_get_contents("content/index/experience.xml"));

$experienceTitle = $experience->getElementsByTagName("title")[0]->textContent;

include(getThemeFile("index-experience-prefix.php"));

foreach($experience->getElementsByTagName('position') as $position) {

	$experiencePositionTitle = $position->getElementsByTagName("title")[0]->textContent;
	$experiencePositionCompany = $position->getElementsByTagName("company")[0]->textContent;
	$experiencePositionPeriod = $position->getElementsByTagName("period")[0]->textContent;
	$experiencePositionLocation = $position->getElementsByTagName("location")[0]->textContent;
	$experiencePositionDescription = $position->getElementsByTagName("description")[0]->textContent;

	include(getThemeFile("index-experience-position.php"));
}

include(getThemeFile("index-experience-suffix.php"));

//
// content index skills

$skills = new DOMDocument();
$skills->loadXML(file_get_contents("content/index/skills.xml"));

$skillsTitle = $skills->getElementsByTagName("title")[0]->textContent;

include(getThemeFile("index-skills-prefix.php"));

foreach($skills->getElementsByTagName('group') as $group) {

	$skillsGroupTitle = $group->getElementsByTagName("title")[0]->textContent;
	$skillsGroupDescription = $group->getElementsByTagName("description")[0]->textContent;

	include(getThemeFile("index-skills-group.php"));
}

include(getThemeFile("index-skills-suffix.php"));

//
// content index suffix

include(getThemeFile("page-suffix.php"));

//
// functions

function printExperienceTitle() {
	global $experienceTitle;
	echo $experienceTitle;
}
function printExperiencePositionTitle() {
	global $experiencePositionTitle;
	echo $experiencePositionTitle;
}
function printExperiencePositionCompany() {
	global $experiencePositionCompany;
	echo $experiencePositionCompany;
}
function printExperiencePositionPeriod() {
	global $experiencePositionPeriod;
	echo $experiencePositionPeriod;
}
function printExperiencePositionLocation() {
	global $experiencePositionLocation;
	echo $experiencePositionLocation;
}
function printExperiencePositionDescription() {
	global $experiencePositionDescription;
	echo $experiencePositionDescription;
}

function printSkillsTitle() {
	global $skillsTitle;
	echo $skillsTitle;
}
function printSkillsGroupTitle() {
	global $skillsGroupTitle;
	echo $skillsGroupTitle;
}
function printSkillsGroupDescription() {
	global $skillsGroupDescription;
	echo $skillsGroupDescription;
}

?>