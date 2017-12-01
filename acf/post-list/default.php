<?php global $post ?>

<section id="post-list">

	<?php if ($data['post-list-title'] or $data['post-list-description']) : ?>
		<header>

			<?php if ($data['post-list-title']) : ?>
				<h2><?php echo $data['post-list-title'] ?></h2>
			<?php endif ?>

			<?php echo $data['post-list-description'] ?>

		</header>
	<?php endif ?>

	<?php foreach ($data['post-list-posts'] as $post) : setup_postdata($post) ?>
		<?php # TODO: If redirect-url is set - open links in new windows ?>
		<article>

			<?php if (has_post_thumbnail()) : ?>
				<figure>
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('medium') ?>
					</a>
				</figure>
			<?php endif ?>

			<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

			<?php the_excerpt() ?>

			<a href="<?php the_permalink() ?>"><?php _e('Read more', 'sleek') ?></a>

		</article>
	<?php endforeach; wp_reset_postdata() ?>

</section>
