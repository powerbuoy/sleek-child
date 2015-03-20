<?php get_header() ?>

<main>

	<h1>I'm a child of SleekWP :)</h1>

	<?php sleek_get_module('post-content') ?>

</main>

<aside id="aside">

	<?php dynamic_sidebar('aside') ?>

</aside>

<?php get_footer() ?>
