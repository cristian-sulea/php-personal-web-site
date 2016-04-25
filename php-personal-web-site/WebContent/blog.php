<?php
include '_include.php';

setContentTypeHTML();
setIsBlog();

if (defined('STDIN')) {
	$_GET[$argv[1]] = $argv[2];
}

if (isset($_GET[getBlogPostIdParam()])) {
	
	setBlogPostId($_GET[getBlogPostIdParam()]);
	
	if (!existsBlogPost()) {
		redirect(getBlogLink());
	}
	
	setIsBlogPost();
	
	readBlogPostConfig();
	readBlogPostContent();
	
	includeThemeHtmlPrefix();
	includeThemeFile('blog-post-full.php');
	includeThemeHtmlSuffix();
}

else if (isset($_GET[getBlogSearchParam()])) {
	
	setBlogSearchQuery(trim($_GET[getBlogSearchParam()]));
	setIsBlogSearch();
	
	if (strlen(getBlogSearchQuery()) == 0) {
		redirect(getBlogLink());
	}
	
	$words = preg_split('/\s+/', getBlogSearchQuery());
	
	includeThemeHtmlPrefix();
	includeThemeFile('blog-search-prefix.php');
	
	$noResults = true;
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		setBlogPostId(basename($blogPostFolder));
		readBlogPostConfig();
		readBlogPostContent();
		
		$blogPostContentStripTags = strip_tags(getBlogPostContent());
		$blogPostContentStripTags = preg_replace('/\s+/', ' ',$blogPostContentStripTags);
		
		$blogPostContainsAllWords = true;
		
		foreach ($words as $word) {
			
			$isFound = false;
			
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
				
				$wordPos = strpos($blogPostContentStripTags, $word);
				
				if ($wordPos !== false) {
					$isFound = true;
				}
			}
			
			//
			// if word not found
			// - reset the "contains all words" flag
			// - and break the cycle through search words
			
			if (!$isFound) {
				$blogPostContainsAllWords = false;
				break;
			}
		}
		
		//
		// if blog post contains all words
		// - create the search result
		// - include the theme file
		
		if ($blogPostContainsAllWords) {
			
			$blogPostContentStripTags = trim($blogPostContentStripTags);
			$blogPostContentStripTags = strtolower($blogPostContentStripTags);
			
			$blogSearchResult = 'Keywords: ' . implode(', ', getBlogPostKeywords()) . '<br>Content: ';
			
			$blogSearchResult .= substr($blogPostContentStripTags, 0, 100);
			$blogSearchResult .= ' ... ';
			
			$wordBlockLength = 400 / count($words);
			
			foreach ($words as $word) {
				
				$wordPos = strpos($blogPostContentStripTags, $word);
				
				$blogSearchResult .= substr($blogPostContentStripTags, max(0, $wordPos - ($wordBlockLength / 2)), $wordBlockLength);
				$blogSearchResult .= ' ... ';
			}
			
			foreach ($words as $word) {
				$blogSearchResult = str_ireplace($word, '<span class="blog-search-result-word">' . $word . '</span>', $blogSearchResult);
			}
			
			setBlogSearchResult($blogSearchResult);
			
			includeThemeFile('blog-search-result.php');
			
			$noResults = false;
		}
	}
	
	if ($noResults) {
		setBlogSearchResult('No results found for "' . getBlogSearchQuery() . '".');
		includeThemeFile('blog-search-result0.php');
	}
	
	includeThemeFile('blog-search-suffix.php');
	includeThemeHtmlSuffix();
}

else {
	
	includeThemeHtmlPrefix();
	
	foreach (getBlogPostFolders() as $blogPostFolder) {
		setBlogPostId(basename($blogPostFolder));
		readBlogPostConfig();
		
		includeThemeFile('blog-post-description.php');
	}
	
	includeThemeHtmlSuffix();
}

?>