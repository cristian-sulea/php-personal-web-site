
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
			<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>" class="author">
				<span class="name"><?php printPostAuthor(); ?></span><img src="<?php printPostAuthorImg(); ?>" alt="" />
			</a>
		</div>

	</header>

	<?php printBlogPostContent(); ?>

	<?php if (hasPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printPostResources(); ?>
	<?php } ?>

</article>
