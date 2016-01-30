<?php

//
// print

function hasPostDescription() {
	global $postConfig;
	return isset($postConfig["description"]);
}

function printPostDescription() {
	global $postConfig;
	echo $postConfig["description"];
}

?>