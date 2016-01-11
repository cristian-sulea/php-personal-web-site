<article>

	<header>
		<h2><?php printSkillsTitle(); ?></h2>
	</header>

	<?php function printSkillsGroup($title, $description) { ?>
		<h3><?php echo $title; ?></h3>
		<?php echo $description ?>
	<?php }; ?>
	<?php printSkills(); ?>

</article>