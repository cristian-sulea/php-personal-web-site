
<article class="post">

	<header>

		<div class="title">
			<h2><?php printIndexLanguagesTitle(); ?></h2>
		</div>

	</header>

	<?php function printLanguagesLanguage($name, $level) { ?>
		<h3><?php echo $name; ?></h3>
		<ul>
			<li><?php echo $level ?></li>
		</ul>
	<?php }; ?>
	<?php printIndexLanguages(); ?>

</article>
