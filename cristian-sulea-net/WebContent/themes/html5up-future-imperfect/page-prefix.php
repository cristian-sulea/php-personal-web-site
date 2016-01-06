<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printTitle(); ?></title>
<meta name="description" content="<?php printDescription(); ?>">
<meta name="keywords" content="<?php printKeywords(); ?>">

<!--[if lte IE 8]><script src="<?php echo THEME;?>/js/ie/html5shiv.js"></script><![endif]-->
<link rel="stylesheet" href="<?php echo THEME;?>/css/main.css" />
<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo THEME;?>/css/ie9.css" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo THEME;?>/css/ie8.css" /><![endif]-->

<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/styles/default.min.css"> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.0.0/highlight.min.js"></script> -->

</head>
<body>

	<div id="wrapper">

		<header id="header">
			<h1><a href="index.php"><?php printTitle(); ?></a></h1>
			<nav class="links">
				<ul>
					<?php foreach ($MENU as $menu) { ?>
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
