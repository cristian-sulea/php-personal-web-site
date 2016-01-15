
<article class="post">

	<header>

		<div class="title">
			<h2><a href="?<?php printPostId(); ?>"><?php printPostTitle(); ?></a></h2>
			<?php if (hasPostDescription()) { ?>
				<p><?php printPostDescription(); ?></p>
			<?php } ?>
		</div>

		<div class="meta">
			<time datetime="<?php printPostDateForTimeTag(); ?>" class="published"><?php printPostDate(); ?></time>
			<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>" class="author">
				<span class="name"><?php printPostAuthor(); ?></span><img src="<?php printPostAuthorImg(); ?>" alt="" />
			</a>
		</div>

	</header>

	<?php printBlogPostContent(); ?>

	<footer>
		<ul class="actions">
			<li><a href="?<?php printPostId(); ?>" class="button big">Continue Reading</a></li>
		</ul>
	</footer>

</article>
