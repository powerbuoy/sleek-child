<?php get_header() ?>

<main>

	<h1>I'm a child of HTML5Base :)</h1>

	<?php include TEMPLATEPATH . '/modules/post-content.php' ?>

</main>

<aside id="aside">

	<?php dynamic_sidebar('aside') ?>

</aside>

<?php get_footer() ?>
