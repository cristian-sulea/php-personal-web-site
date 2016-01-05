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
			<a href="#" class="author"><span class="name">Jane Doe</span><img src="images/avatar.jpg" alt="" /></a>
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