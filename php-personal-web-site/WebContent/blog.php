<?php
include '_include.php';

setContentTypeHTML();
setIsBlog();

if (isset($_GET[getBlogPostIdParam()])) {
	
	setBlogPostId($_GET[getBlogPostIdParam()]);
	
	if (!existsBlogPost()) {
		redirect(getBlogLink());
	}
	
	setIsBlogPost();
	
	readBlogPostConfig();
	readBlogPostContent();
	
	includeThemeFile('page-prefix.php');
	includeThemeFile('blog-post-full.php');
	includeThemeFile('page-suffix.php');
}

else if (isset($_GET[getBlogSearchParam()])) {
	
	setBlogSearchQuery($_GET[getBlogSearchParam()]);
	setIsBlogSearch();
	
	$words = preg_split('/\s+/', trim(getBlogSearchQuery()));
	
	includeThemeFile('page-prefix.php');
	includeThemeFile('blog-search-prefix.php');
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		setBlogPostId(basename($blogPostFolder));
		readBlogPostConfig();
		readBlogPostContent();
		
		foreach ($words as $word) {
			
			$isFound = false;
			$blogPostContentStripTags = null;
			
			//
			// first check in title
			
			if (stripos(getBlogPostTitle(), $word) !== false) {
				$isFound = true;
			}
			
			//
			// then in keywords
			
			else if (stripos(implode('', getBlogPostKeywords()), $word) !== false) {
				$isFound = true;
			}
			
			//
			// then in description
			
			else if (stripos(getBlogPostDescription(), $word) !== false) {
				$isFound = true;
			}
			
			//
			// then in content
			
			else {
				
				$blogPostContentStripTags = strip_tags(getBlogPostContent());
				$blogPostContentStripTags = preg_replace('/\s+/', ' ',$blogPostContentStripTags);
				
				$wordPos = strpos($blogPostContentStripTags, $word);
				
				if ($wordPos !== false) {
					$isFound = true;
				}
			}
			
			//
			// if found
			// - create the search result
			// - include the theme file
			// - and break the cycle through search words
			
			if ($isFound) {
				
				if (is_null($blogPostContentStripTags)) {
					$blogPostContentStripTags = strip_tags(getBlogPostContent());
					$blogPostContentStripTags = preg_replace('/\s+/', ' ',$blogPostContentStripTags);
				}
				
				$blogPostContentStripTags = trim($blogPostContentStripTags);
				$blogPostContentStripTags = strtolower($blogPostContentStripTags);
				
				$blogSearchResult = 'Keywords: ' . implode(', ', getBlogPostKeywords()) . '<br>Content: ';
				
				$blogSearchResult .= substr($blogPostContentStripTags, 0, 100);
				$blogSearchResult .= ' ... ';
				$blogSearchResult .= substr($blogPostContentStripTags, max(0, $wordPos - 200), 400);
				$blogSearchResult .= ' ... ';
				
				$blogSearchResult = str_ireplace($word, '<span class="blog-search-result-word">' . $word . '</span>', $blogSearchResult);
				
				setBlogSearchResult($blogSearchResult);
				
				includeThemeFile('blog-search-result.php');
				break;
			}
		}
	}
	
	includeThemeFile('blog-search-suffix.php');
	includeThemeFile('page-suffix.php');
}

else {
	
	includeThemeFile('page-prefix.php');
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		setBlogPostId(basename($blogPostFolder));
		readBlogPostConfig();
		
		includeThemeFile('blog-post-description.php');
	}
	
	includeThemeFile('page-suffix.php');
}

?>