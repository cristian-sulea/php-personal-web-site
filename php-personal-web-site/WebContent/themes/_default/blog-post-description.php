
<article>

	<header>
		<h2><a href="<?php printBlogPostLink(); ?>"><?php printBlogPostTitle(); ?></a></h2>
		<a href="<?php printBlogPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>"><img src="<?php printBlogPostAuthorImage(64); ?>" alt="" /></a>
		<a href="<?php printBlogPostAuthorWebsite(); ?>" title="<?php printBlogPostAuthor(); ?>"><?php printBlogPostAuthor(); ?></a>
		,
		<time datetime="<?php printBlogPostDateForHtmlTimeTag(); ?>"><?php printBlogPostDate(); ?></time>
	</header>

	<p><?php printBlogPostDescription(); ?></p>

	<footer>
		<a href="<?php printBlogPostLink(); ?>">Continue Reading</a>
	</footer>

</article>
