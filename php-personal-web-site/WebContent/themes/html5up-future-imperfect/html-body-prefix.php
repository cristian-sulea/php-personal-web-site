<div id="wrapper">

	<header id="header">
		<h1><a href="index.php"><?php printAuthorName(); ?></a></h1>
		<nav class="links">
			<?php printMenuItems(); ?>
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
			<?php printMenuItems('links'); ?>
		</div>
		<div>
			<ul class="actions vertical">
				<li><a href="" class="button icon fa-close fit" onclick="document.getElementsByTagName('body')[0].className = ''; return false;">Close Menu</a></li>
			</ul>
		</div>
	</div>

	<div id="main">

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
