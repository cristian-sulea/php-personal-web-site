
<article>

	<header>
		<h2><?php printBlogPostTitle(); ?></h2>
		<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>"><?php printBlogPostDate(); ?></time>
		<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>"><?php printPostAuthor(); ?></a>
	</header>

	<?php printBlogPostContent(); ?>

	<?php if (hasBlogPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printBlogPostResources(); ?>
	<?php } ?>

</article>
