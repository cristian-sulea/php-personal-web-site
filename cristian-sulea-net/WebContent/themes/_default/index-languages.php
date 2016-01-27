<article>

	<header>
		<h2><?php printLanguagesTitle(); ?></h2>
	</header>

	<?php function printLanguagesLanguage($name, $level) { ?>
		<h3><?php echo $name; ?></h3>
		<ul>
			<li><?php echo $level ?></li>
		</ul>
	<?php }; ?>
	<?php printLanguages(); ?>

</article>
