<?php get_header() ?>

<main>

	<?php get_template_part('modules/single-post-page') ?>
	<?php SleekACF::renderModules('below_content') ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
