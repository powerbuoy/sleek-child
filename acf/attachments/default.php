<section id="attachments">

	<?php if ($data['attachments-title'] or $data['attachments-description']) : ?>
		<header>

			<?php if ($data['attachments-title']) : ?>
				<h2><?php echo $data['attachments-title'] ?></h2>
			<?php endif ?>

			<?php echo $data['attachments-description'] ?>

		</header>
	<?php endif ?>

	<ul>
		<?php foreach ($data['attachments-files'] as $file) : ?>
			<li>
				<a href="<?php echo $file['attachments-files-file']['url'] ?>">
					<?php echo $file['attachments-files-file']['title'] ?>
					<small>(<?php echo wp_check_filetype($file['attachments-files-file']['filename'])['ext'] ?>)</small>
				</a>
			</li>
		<?php endforeach ?>
	</ul>

</section>
