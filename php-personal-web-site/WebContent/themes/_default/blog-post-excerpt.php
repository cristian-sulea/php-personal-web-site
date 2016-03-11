
<article>

	<header>
		<h2><a href="?<?php printPostId(); ?>"><?php printBlogPostTitle(); ?></a></h2>
		<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>"><?php printBlogPostDate(); ?></time>
		<a href="<?php printBlogPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>"><?php printBlogPostAuthor(); ?></a>
	</header>

	<?php printBlogPostContent(); ?>

	<footer>
		<a href="?<?php printPostId(); ?>">Continue Reading</a>
	</footer>

</article>
