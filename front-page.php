<?php get_header() ?>

<main>

	<?php get_template_part('modules/page') ?>

	<h2><code>README.md</code> <small>(Remove in <code>front-page.php</code>)</small></h2>
	<pre><?php include get_template_directory() . '/README.md' ?></pre>

	<?php sleek_render_acf_modules('below-content') ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
