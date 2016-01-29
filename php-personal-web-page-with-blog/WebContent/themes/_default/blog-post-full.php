
<article>

	<header>
		<h2><?php printBlogPostTitle(); ?></h2>
		<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>"><?php printBlogPostDate(); ?></time>
		<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>"><?php printBlogPostAuthor(); ?></a>
	</header>

	<?php printBlogPostContent(); ?>

	<?php if (hasBlogPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printBlogPostResources(); ?>
	<?php } ?>

</article>
