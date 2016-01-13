<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printHtmlHeadTitle(); ?></title>

<meta name="description" content="<?php printHtmlHeadMetaDescription(); ?>">
<meta name="keywords"    content="<?php printHtmlHeadMetaKeywords(); ?>">
<meta name="author"      content="<?php printHtmlHeadMetaAuthor(); ?>">

<link rel="icon" href="<?php printHtmlHeadRelIcon(); ?>">

<!--[if lte IE 8]><script src="<?php printThemeFile("js/ie/html5shiv.js"); ?>"></script><![endif]-->
<link rel="stylesheet" href="<?php printThemeFile("css/main.css"); ?>" />
<!--[if lte IE 9]><link rel="stylesheet" href="<?php printThemeFile("css/ie9.css"); ?>" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="<?php printThemeFile("css/ie8.css"); ?>" /><![endif]-->

</head>
<body>

	<?php echo '<div id="wrapper">'; ?>

		<header id="header">
			<h1><a href="index.php"><?php printAuthorName(); ?></a></h1>
			<nav class="links">
				<ul>
					<?php printMenuItems(); ?>
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

		<?php echo '<div id="main">'; ?>

			<section id="intro">
				<?php if (isIndex()) { ?>
					<a class="logo"><img src="<?php printIndexLogo(); ?>" alt="" /></a>
					<header>
						<h2><a href="index.php"><?php printAuthorName(); ?></a></h2>
						<p><?php printAuthorDescription(); ?></p>
						<ul class="icons">
							<?php printAuthorProfiles(); ?>
						</ul>
					</header>
				<?php } else if (isBlog()) { ?>
					<a class="logo"><img src="<?php printBlogLogo(); ?>" alt="" /></a>
					<header>
						<h2><a href="blog.php"><?php printBlogTitle(); ?></a></h2>
						<p><?php printBlogDescription(); ?></p>
					</header>
				<?php } else { errorUnknownPageType(); } ?>
			</section>
