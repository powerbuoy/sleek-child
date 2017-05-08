<?php get_header() ?>

<main>

	<?php get_template_part('modules/page') ?>
	<?php get_template_part('modules/my-module') ?>
	<pre><?php include get_template_directory() . '/README.md' ?></pre>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
