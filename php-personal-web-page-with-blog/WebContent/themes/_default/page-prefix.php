<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printHtmlHeadTitle(); ?></title>

<meta name="description" content="<?php printHtmlHeadMetaDescription(); ?>">
<meta name="keywords"    content="<?php printHtmlHeadMetaKeywords(); ?>">

</head>
<body>

	<header>
		<h1><a href="index.php"><?php printTitle(); ?></a></h1>
		<nav>
			<ul>
				<?php foreach (getMenu() as $menu) { ?>
					<li><a href="<?php echo $menu[1]; ?>"><?php echo $menu[0]; ?></a></li>
				<?php } ?>
			</ul>
		</nav>
		<nav>
			<form method="get" action="search.php">
				<input type="text" name="query" placeholder="Search" />
			</form>
		</nav>
		<?php if (isBlog()) { ?>
			<h2><?php printBlogTitle(); ?></h2>
			<p><?php printBlogDescription(); ?></p>
		<?php } else { ?>
			<h2><?php printTitle(); ?></h2>
			<p><?php printDescription(); ?></p>
			<ul>
				<?php function printProfile($title, $link) { ?>
	    			<li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
				<?php }; ?>
				<?php printProfiles(); ?>
			</ul>
		<?php } ?>
	</header>
