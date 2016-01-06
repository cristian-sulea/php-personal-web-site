<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printTitle(); ?></title>
<meta name="description" content="<?php printDescription(); ?>">
<meta name="keywords" content="<?php printKeywords(); ?>">

</head>
<body>

	<header>
		<h1>
			<?php printTitle(); ?>
		</h1>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="blog.php">Blog</a></li>
				<li><a href="photos.php">Photos</a></li>
			</ul>
		</nav>
		<nav>
			<form method="get" action="search.php">
				<input type="text" name="query" placeholder="Search" />
			</form>
		</nav>
	</header>
