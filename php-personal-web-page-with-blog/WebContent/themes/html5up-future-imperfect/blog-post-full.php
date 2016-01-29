
<article class="post">

	<header>

		<div class="title">
			<h2><?php printBlogPostTitle(); ?></h2>
			<?php if (hasPostDescription()) { ?>
				<p><?php printPostDescription(); ?></p>
			<?php } ?>
		</div>

		<div class="meta">
			<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>" class="published"><?php printBlogPostDate(); ?></time>
			<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>" class="author">
				<span class="name"><?php printBlogPostAuthor(); ?></span><img src="<?php printPostAuthorImg(); ?>" alt="" />
			</a>
		</div>

	</header>

	<?php printBlogPostContent(); ?>

	<?php if (hasBlogPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printBlogPostResources(); ?>
	<?php } ?>

</article>
