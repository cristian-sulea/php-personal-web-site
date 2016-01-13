<?php

//
// logo

function printBlogLogo() {
	echo "config/blog-logo.jpg";
}

//
// print

function printPostId() {
	global $postId;
	echo $postId;
}

function printPostTitle() {
	global $postConfig;
	echo $postConfig["title"];
}

function printPostDate() {
	global $postConfig;
	global $POST_DATE_FORMAT;
	echo date($POST_DATE_FORMAT, strtotime($postConfig["date"]));
}

function printPostDateForTimeTag() {
	global $postConfig;
	echo date("Y-m-d", strtotime($postConfig["date"]));
}

function printPostAuthor() {
	global $postConfig;
	if (isset($postConfig["author"])) {
		echo $postConfig["author"];
	} else {
		printAuthorName();
	}
}

function printPostAuthorImg() {
	global $postConfig;
	if (isset($postConfig["author-email"])) {
		echo getGravatarImg($postConfig["author-email"]);
	} else {
		if (isset($postConfig["author"])) {
			echo getGravatarImg("");
		} else {
			echo "config/blog-author.jpg";
		}
	}
}

function printPostAuthorWebsite() {
	global $postConfig;
	if (isset($postConfig["author-website"])) {
		echo $postConfig["author-website"];
	} else {
		if (isset($postConfig["author"])) {
			echo "";
		} else {
			echo "http://" . $_SERVER['HTTP_HOST'];
		}
	}
}

function hasPostDescription() {
	global $postConfig;
	return isset($postConfig["description"]);
}

function printPostDescription() {
	global $postConfig;
	echo $postConfig["description"];
}

function hasPostImage() {
	global $postConfig;
	return isset($postConfig["image"]);
}

function printPostImage() {
	global $postId;
	global $postConfig;
	echo "content/blog/" . $postId . "/images/". $postConfig["image"];
}

function printBlogPostContent() {
	global $blogPostContent;
	global $postId;
	
	$blogPostContent = str_replace('="images/', '="content/blog/' . $postId . '/images/', $blogPostContent);
	
	$blogPostContent = str_replace(
			array('<pre>' . "\r\n",
					'<pre>' . "\r",
					'<pre>' . "\n",
					'<pre>' . "\n\r"),
			'<pre>',
			$blogPostContent);
	
	echo PHP_EOL;
	
	if (function_exists('theme_printBlogPostContent')) {
		theme_printBlogPostContent($blogPostContent);
	}
	
	else {
		echo $blogPostContent;
	}
}

function hasPostResources() {
	global $postConfig;
	return isset($postConfig["resources"]);
}

function printPostResources() {
	global $postConfig;
	echo  PHP_EOL;
	echo '<b>Resources</b>' . PHP_EOL;
	echo '<ul>' . PHP_EOL;
	foreach ($postConfig["resources"] as $resource) {
		echo '<li><a href="' . $resource[1] . '">' . $resource[0] . '</a></li>' . PHP_EOL;
	}
	echo '</ul>';
}

?>