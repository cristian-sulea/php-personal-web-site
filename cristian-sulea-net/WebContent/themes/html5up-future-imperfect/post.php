<article class="post">

	<header>

		<div class="title">
			<h2><a href="#"><?php printPostTitle(); ?></a></h2>
			<?php if (hasPostDescription()) { ?>
				<p><?php printPostDescription(); ?></p>
			<?php } ?>
		</div>

		<div class="meta">
			<time class="published" datetime="<?php printPostDateForTimeTag(); ?>"><?php printPostDate(); ?></time>
			<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>" class="author">
				<span class="name"><?php printPostAuthor(); ?></span>
				<img src="<?php printPostAuthorImg(); ?>" alt="<?php printPostAuthor(); ?>" title="<?php printPostAuthor(); ?>" />
			</a>
		</div>

	</header>

	<?php if (hasPostImage()) { ?>
		<a class="image featured"><img src="<?php printPostImage(); ?>" alt="<?php printPostTitle(); ?>" title="<?php printPostTitle(); ?>" /></a>
	<?php } ?>

	<?php printPostContent('image'); ?>

	<?php if (hasPostResources()) { ?>
		<?php echo '<hr />'; ?>
		<?php printPostResources(); ?>
	<?php } ?>

</article>

<?php

//
// functions

function themeUpdatePostContent($postContent) {

	$postContent = str_replace(
							array('<pre>', '</pre>'),
							array('<pre><code>', '</code></pre>'),
							$postContent);

	return $postContent;
}

?>