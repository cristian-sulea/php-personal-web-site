		<?php echo '</div>'; ?>

		<footer id="sidebar">
			<div id="footer">
				<?php if (isBlog()) { ?>
					<!-- nothing to do (yet) -->
				<?php } else { ?>
					<ul class="icons">
					<?php printProfiles(); ?>
				</ul>
				<?php } ?>
				<p class="copyright">
					&copy; <a href="http://cristian.sulea.net">Cristian Sulea</a>. Design: <a href="http://html5up.net">HTML5 UP</a>.
				</p>
			</div>
		</footer>

	<?php echo '</div>'; ?>

</body>
</html>