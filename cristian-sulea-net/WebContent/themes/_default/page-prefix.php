<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printTitle(); ?></title>
<meta name="description" content="<?php printDescription(); ?>">
<meta name="keywords" content="<?php printKeywords(); ?>">

</head>
<body>

	<header>
		<h1><?php printTitle(); ?></h1>
		<nav>
			<ul>
				<?php foreach ($MENU as $menu) { ?>
					<li><a href="<?php echo $menu[1]; ?>"><?php echo $menu[0]; ?></a></li>
				<?php } ?>
			</ul>
		</nav>
		<nav>
			<form method="get" action="search.php">
				<input type="text" name="query" placeholder="Search" />
			</form>
		</nav>
	</header>
