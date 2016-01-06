
<article>

	<header>
		<h2><?php printPostTitle(); ?></h2>
		<time datetime="<?php printPostDateForTimeTag(); ?>"><?php printPostDate(); ?></time>
		<a href="<?php printPostAuthorWebsite(); ?>" title="<?php printPostAuthor(); ?>"><?php printPostAuthor(); ?></a>
	</header>

	<?php printPostContent(); ?>

</article>
