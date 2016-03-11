
<article class="post">

	<header>

		<div class="title">
			<h2><?php printIndexSkillsTitle(); ?></h2>
		</div>

	</header>

	<?php function printSkillsGroup($title, $description) { ?>
		<h3><?php echo $title; ?></h3>
		<?php echo $description ?>
	<?php }; ?>
	<?php printIndexSkills(); ?>

</article>
