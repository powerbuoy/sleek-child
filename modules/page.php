<section id="page">

	<?php while (have_posts()) : the_post() ?>
		<header>

			<h1><?php the_title() ?></h1>

			<figure>
				<?php the_post_thumbnail('large') ?>
			</figure>

			<?php the_excerpt() ?>

			<?php sleek_render_acf_modules('inside-hero') ?>

		</header>

		<?php get_template_part('modules/breadcrumbs') ?>

		<?php if (get_field('modules-next-to-content') and !post_password_required()) : ?>
			<div>

				<article>

					<?php the_content() ?>
					<?php wp_link_pages() ?>

				</article>

				<aside>

					<?php sleek_render_acf_modules('next-to-content') ?>

				</aside>

			</div>
		<?php else : ?>
			<article>

				<?php the_content() ?>
				<?php wp_link_pages() ?>

			</article>
		<?php endif ?>
	<?php endwhile ?>

</section>
