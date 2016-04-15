<?php get_header() ?>

<main>

	<h1>I'm a child of SleekWP :)</h1>

	<?php get_template_part('modules/post-content') ?>

</main>

<aside id="aside">

	<?php dynamic_sidebar('aside') ?>

</aside>

<?php get_footer() ?>
