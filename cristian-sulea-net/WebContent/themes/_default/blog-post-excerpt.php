
<article>

	<header>
		<h2><a href="?<?php printPostId(); ?>"><?php printPostTitle(); ?></a></h2>
		<time datetime="<?php printPostDateForTimeTag(); ?>"><?php printPostDate(); ?></time>
		<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>"><?php printPostAuthor(); ?></a>
	</header>

	<?php printPostContent('image'); ?>

	<footer>
		<a href="?<?php printPostId(); ?>">Continue Reading</a>
	</footer>

</article>
