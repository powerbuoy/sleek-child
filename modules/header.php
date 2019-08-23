<header id="header">

	<?php the_custom_logo() ?>

	<?php if (get_bloginfo('description')) : ?>
		<p class="tagline">
			<?php echo str_replace(['&lt;', '&gt;'], ['<', '>'], get_bloginfo('description')) # Support for HTML in site tagline ?>
		</p>
	<?php endif ?>

	<nav>
		<?php dynamic_sidebar('header') ?>
	</nav>

	<a href="#header" class="menu-toggle" title="<?php _e('Open menu', 'sleek') ?>" data-toggle-hash></a>

</header>
