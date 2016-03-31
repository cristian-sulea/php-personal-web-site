
<ul>

<?php foreach (getAuthorProfiles() as  $title => $link ) { ?>
  <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a></li>
<?php } ?>

</ul>
