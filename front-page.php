<?php get_header() ?>

<main>

	<h1><?php _e('test', 'sleek_child') ?></h1>
	<?php get_template_part('modules/page') ?>
	<?php sleek_render_acf_modules('below-content') ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
