
<article class="post">

	<header>

		<div class="title">
			<h2><?php printBlogPostTitle(); ?></h2>
		</div>

		<div class="meta">
			<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>" class="published"><?php printBlogPostDate(); ?></time>
			<a href="<?php printBlogPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>" class="author">
				<span class="name"><?php printBlogPostAuthor(); ?></span><img src="<?php printBlogPostAuthorImage(); ?>" alt="" />
			</a>
		</div>

	</header>

<?php printBlogPostContent(); ?>

	<?php if (hasBlogPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printBlogPostResources(); ?>
	<?php } ?>

</article>
