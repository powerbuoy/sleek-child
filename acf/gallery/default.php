<section id="gallery">

	<?php if ($data['gallery-title'] or $data['gallery-description']) : ?>
		<header>

			<?php if ($data['gallery-title']) : ?>
				<h2><?php echo $data['gallery-title'] ?></h2>
			<?php endif ?>

			<?php echo $data['gallery-description'] ?>

		</header>
	<?php endif ?>

	<ul>
		<?php foreach ($data['gallery-images'] as $image) : ?>
			<li>
				<figure>
					<a href="<?php echo $image['url'] ?>">
						<?php echo wp_get_attachment_image($image['id'], 'medium') ?>
					</a>

					<figcaption>

						<h3><?php echo $image['title'] ?></h3>

						<?php echo wpautop($image['caption']) ?>
						<?php echo wpautop($image['description']) ?>

					</figcaption>
				</figure>
			</li>
		<?php endforeach ?>
	</ul>

</section>
