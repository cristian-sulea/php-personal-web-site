
<article class="post">

	<header>

		<div class="title">
			<h2><?php printIndexExperienceTitle(); ?></h2>
		</div>

	</header>

	<?php function printExperiencePosition($title, $company, $period, $location, $description) { ?>
		<h3><?php echo $title; ?></h3>
		<p>
			<?php echo $company; ?><br>
			<i><?php echo $period; ?></i> | <i><?php echo $location; ?></i>
		</p>
		<?php echo $description ?>
	<?php }; ?>
	<?php printIndexExperience(); ?>

</article>
