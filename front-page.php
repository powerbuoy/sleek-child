<?php get_header() ?>

<main>

	<pre>
		<?php include get_template_directory() . '/README.md' ?>
	</pre>

	<?php get_template_part('modules/my-module') ?>
	<?php get_template_part('modules/post-content') ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
