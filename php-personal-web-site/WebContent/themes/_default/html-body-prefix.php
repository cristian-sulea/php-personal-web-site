
<header>
	<h1><a href="index.php"><?php printAuthorName(); ?></a></h1>
	<nav>
		<?php printMenuItems(); ?>
	</nav>
	<nav>
		<form method="get" action="<?php printBlogLink(); ?>">
			<input type="text" name="<?php printBlogSearchParam(); ?>" value="<?php printBlogSearchQuery(); ?>" placeholder="Search" />
		</form>
	</nav>
	<?php if (isIndex()) { ?>
		<p><img src="<?php printIndexLogo('128'); ?>" alt="" /></p>
		<h2><a href="<?php printIndexLink(); ?>"><?php printAuthorName(); ?></a></h2>
		<p><?php printAuthorTitle(); ?></p>
		<?php printAuthorProfiles(); ?>
	<?php } else if (isBlog()) { ?>
		<p><img src="<?php printBlogLogo('128'); ?>" alt="" /></p>
		<h2><a href="<?php printBlogLink(); ?>"><?php printBlogTitle(); ?></a></h2>
		<p><?php printBlogDescription(); ?></p>
	<?php } else { throwUnknownPageTypeException(); } ?>
</header>
