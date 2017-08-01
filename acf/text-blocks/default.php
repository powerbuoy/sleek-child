<section id="text-blocks">

	<?php if ($data['text-blocks-title'] or $data['text-blocks-description']) : ?>
		<header>

			<?php if ($data['text-blocks-title']) : ?>
				<h2><?php echo $data['text-blocks-title'] ?></h2>
			<?php endif ?>

			<?php echo $data['text-blocks-description'] ?>

		</header>
	<?php endif ?>

	<?php foreach ($data['text-blocks'] as $block) : ?>
		<article>

			<?php if ($block['text-block-image']) : ?>
				<figure>
					<?php echo wp_get_attachment_image($block['text-block-image'], 'large') ?>
				</figure>
			<?php endif ?>

			<?php if ($block['text-block-title']) : ?>
				<h3><?php echo $block['text-block-title'] ?></h3>
			<?php endif ?>

			<?php echo $block['text-block-description'] ?>

			<?php sleek_get_template_part('acf/buttons/default', ['data' => ['buttons' => $block['text-block-buttons']]]) ?>

		</article>
	<?php endforeach ?>

</section>
