<?php
$AUTHOR_PROFILES_CLASSES['LinkedIn']    = 'fa-linkedin-square';
$AUTHOR_PROFILES_CLASSES['Google+']     = 'fa-google-plus-square';
$AUTHOR_PROFILES_CLASSES['Twitter']     = 'fa-twitter-square';
$AUTHOR_PROFILES_CLASSES['GitHub']      = 'fa-github-square';
$AUTHOR_PROFILES_CLASSES['SourceForge'] = 'fa-pencil-square';
?>

<ul class="icons">

<?php foreach (getAuthorProfiles() as  $title => $link ) { ?>
  <li><a href="<?php echo $link; ?>" class="<?php echo $AUTHOR_PROFILES_CLASSES[$title]; ?>">&nbsp;<?php echo $title; ?></a></li>
<?php } ?>

</ul>
