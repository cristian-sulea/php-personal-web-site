
<article class="post">

	<header>

		<div class="title">
			<h2><?php printPostTitle(); ?></h2>
			<?php if (hasPostDescription()) { ?>
				<p><?php printPostDescription(); ?></p>
			<?php } ?>
		</div>

		<div class="meta">
			<time datetime="<?php printPostDateForTimeTag(); ?>" class="published"><?php printPostDate(); ?></time>
			<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>" class="author">
				<span class="name"><?php printPostAuthor(); ?></span><img src="<?php printPostAuthorImg(); ?>" alt="<?php printPostAuthor(); ?>" title="<?php printPostAuthor(); ?>" />
			</a>
		</div>

	</header>

	<?php printPostContent(); ?>

	<?php if (hasPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printPostResources(); ?>
	<?php } ?>

</article>
