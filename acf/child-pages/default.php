<?php
	global $post;

	$rows = get_pages([
		'parent' => $post->ID,
		'sort_column' => 'menu_order',
		'sort_order' => 'ASC'
	]);
?>

<?php if ($rows) : ?>
	<section id="child-pages">

		<?php if ($data['child-pages-title'] or $data['child-pages-description']) : ?>
			<header>

				<?php if ($data['child-pages-title']) : ?>
					<h2><?php echo $data['child-pages-title'] ?></h2>
				<?php endif ?>

				<?php echo $data['child-pages-description'] ?>

			</header>
		<?php endif ?>

		<?php foreach ($rows as $post) : setup_postdata($post) ?>
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

				<?php sleek_get_template_part('acf/buttons/default', ['data' => ['buttons' => get_field('buttons')]]) ?>

				<a href="<?php the_permalink() ?>"><?php _e('Read more', 'sleek') ?></a>

			</article>
		<?php endforeach; wp_reset_postdata() ?>

	</section>
<?php else : ?>
	<p class="error"><?php _e('This page does not have any child pages. You can remove this module until you add some.', 'sleek_child') ?></p>
<?php endif ?>
