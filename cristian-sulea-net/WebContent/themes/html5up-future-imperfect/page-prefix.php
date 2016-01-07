<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printHtmlHeadTitle(); ?></title>

<meta name="description" content="<?php printHtmlHeadMetaDescription(); ?>">
<meta name="keywords"    content="<?php printHtmlHeadMetaKeywords(); ?>">

<!--[if lte IE 8]><script src="<?php printThemeFile("js/ie/html5shiv.js"); ?>"></script><![endif]-->
<link rel="stylesheet" href="<?php printThemeFile("css/main.css"); ?>" />
<!--[if lte IE 9]><link rel="stylesheet" href="<?php printThemeFile("css/ie9.css"); ?>" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="<?php printThemeFile("css/ie8.css"); ?>" /><![endif]-->

</head>
<body>

	<div id="wrapper">

		<header id="header">
			<h1><a href="index.php"><?php printTitle(); ?></a></h1>
			<nav class="links">
				<ul>
					<?php foreach (getMenu() as $menu) { ?>
						<li><a href="<?php echo $menu[1]; ?>"><?php echo $menu[0]; ?></a></li>
					<?php } ?>
				</ul>
			</nav>
			<nav class="main">
				<ul>
					<li class="search">
						<a class="fa-search" href="#search">Search</a>
						<form id="search" method="get" action="search.php">
							<input type="text" name="query" placeholder="Search" />
						</form>
					</li>
				</ul>
			</nav>
		</header>

		<div id="main">

			<section id="intro">
				<a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
				<header>
					<?php if (isBlog()) { ?>
						<h2><a href="blog.php"><?php printBlogTitle(); ?></a></h2>
						<p><?php printBlogDescription(); ?></p>
					<?php } else { ?>
						<h2><?php printTitle(); ?></h2>
						<p><?php printDescription(); ?></p>
					<?php } ?>
				</header>
			</section>
