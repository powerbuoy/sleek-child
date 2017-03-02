<section class="section">

	<?php if ($data['text-content-title']) : ?>
		<h2><?php echo $data['text-content-title'] ?></h2>
	<?php endif ?>

	<?php if ($data['text-content-image']) : ?>
		<img src="<?php echo $data['text-content-image']['url'] ?>">
	<?php endif ?>

	<?php echo $data['text-content-content'] ?>

	<?php sleek_get_template_part('acf/buttons/default', ['data' => ['buttons' => $data['text-content-buttons']]]) ?>

</section>
