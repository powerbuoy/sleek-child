<?php
	global $post;

	$rows = [];
	$thisId = $post->ID;

	if ($post->post_parent) {
		$rows = get_pages([
			'parent' => $post->post_parent,
			'sort_column' => 'menu_order',
			'sort_order' => 'ASC'
		]);
	}
?>

<?php if ($rows) : ?>
	<section id="sibling-pages">

		<?php if ($data['sibling-pages-title'] or $data['sibling-pages-description']) : ?>
			<header>

				<?php if ($data['sibling-pages-title']) : ?>
					<h2><?php echo $data['sibling-pages-title'] ?></h2>
				<?php endif ?>

				<?php echo $data['sibling-pages-description'] ?>

			</header>
		<?php endif ?>

		<?php foreach ($rows as $post) : setup_postdata($post) ?>
			<?php # TODO: If redirect-url is set - open links in new windows ?>
			<article>

				<?php if (has_post_thumbnail()) : ?>
					<figure>
						<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('large') ?>
						</a>
					</figure>
				<?php endif ?>

				<h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

				<?php the_excerpt() ?>

				<?php sleek_get_template_part('acf/buttons/default', ['data' => ['buttons' => get_field('buttons')]]) ?>

				<a href="<?php the_permalink() ?>"><?php _e('Read more', 'sleek_child') ?></a>

			</article>
		<?php endforeach; wp_reset_postdata() ?>

	</section>
<?php endif ?>
