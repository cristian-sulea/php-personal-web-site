<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printHtmlHeadTitle(); ?></title>

<meta name="description" content="<?php printHtmlHeadMetaDescription(); ?>">
<meta name="keywords"    content="<?php printHtmlHeadMetaKeywords(); ?>">
<meta name="author"      content="<?php printHtmlHeadMetaAuthor(); ?>">

<link rel="icon" href="<?php printHtmlHeadLinkIcon(); ?>">

<link rel="canonical" href="<?php printHtmlHeadLinkCanonical(); ?>">
<link rel="shortlink" href="<?php printHtmlHeadLinkShortlink(); ?>">

<link rel="alternate" type="application/rss+xml" title="<?php printBlogTitle(); ?> &raquo; Feed" href="feed.php" />

<!--[if lte IE 8]><script src="<?php printThemeFile('js/ie/html5shiv.js'); ?>"></script><![endif]-->
<link rel="stylesheet" href="<?php printThemeFile('css/main.min.css?v=2016.03.25.1'); ?>" />
<!--[if lte IE 9]><link rel="stylesheet" href="<?php printThemeFile('css/ie9.css'); ?>" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="<?php printThemeFile('css/ie8.css'); ?>" /><![endif]-->

<?php printGoogleAnalyticsTrackingCode(); ?>

<?php printGoogleStructuredData(); ?>

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
						<form id="search" method="get" action="<?php printBlogLink(); ?>">
							<input type="text" name="<?php printBlogSearchParam(); ?>" value="<?php printBlogSearchQuery(); ?>" placeholder="Search" />
						</form>
					</li>
					<li class="menu"><a href="" class="fa-bars" onclick="document.getElementsByTagName('body')[0].className = 'is-menu-visible'; return false;">Menu</a></li>
				</ul>
			</nav>
		</header>

		<div id="menu">
			<div>
				<form class="search" method="get" action="<?php printBlogLink(); ?>">
					<input type="text" name="<?php printBlogSearchParam(); ?>" value="<?php printBlogSearchQuery(); ?>" placeholder="Search" />
				</form>
			</div>
			<div>
				<ul class="links">
					<?php printMenuItems(); ?>
				</ul>
			</div>
			<div>
				<ul class="actions vertical">
					<li><a href="" class="button icon fa-close fit" onclick="document.getElementsByTagName('body')[0].className = ''; return false;">Close Menu</a></li>
				</ul>
			</div>
		</div>

		<?php echo '<div id="main">'; ?>

			<section id="intro">
				<?php if (isIndex()) { ?>
					<a class="logo"><img src="<?php printIndexLogo('128'); ?>" alt="" /></a>
					<header>
						<h2><a href="index.php"><?php printAuthorName(); ?></a></h2>
						<p><?php printAuthorTitle(); ?></p>
						<?php printAuthorProfiles(); ?>
					</header>
				<?php } else if (isBlog()) { ?>
					<a class="logo"><img src="<?php printBlogLogo('128'); ?>" alt="" /></a>
					<header>
						<h2><a href="blog.php"><?php printBlogTitle(); ?></a></h2>
						<p><?php printBlogDescription(); ?></p>
					</header>
				<?php } else { throwUnknownPageTypeException(); } ?>
			</section>
