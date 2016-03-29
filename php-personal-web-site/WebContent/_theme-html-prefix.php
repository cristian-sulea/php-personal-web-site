<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php printHtmlHeadTitle(); ?></title>

<meta name="description" content="<?php printHtmlHeadMetaDescription(); ?>">
<meta name="keywords"    content="<?php printHtmlHeadMetaKeywords(); ?>">
<meta name="author"      content="<?php printHtmlHeadMetaAuthor(); ?>">

<link rel="icon" href="<?php printHtmlHeadLinkIcon(); ?>">

<link rel="canonical" href="<?php printHtmlHeadLinkCanonical(); ?>">
<link rel="shortlink" href="<?php printHtmlHeadLinkShortlink(); ?>">

<link rel="alternate" type="application/rss+xml" title="<?php printBlogTitle(); ?> &raquo; Feed" href="feed.php" />

<?php includeThemeFile('html-head.php'); ?>

<?php printGoogleAnalyticsTrackingCode(); ?>

<?php printGoogleStructuredData(); ?>

</head>
<body>

<?php includeThemeFile('html-body-prefix.php'); ?>