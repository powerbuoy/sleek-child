<?php if ($data['buttons']) : ?>
	<nav class="buttons">

		<?php foreach ($data['buttons'] as $button) : ?>
			<?php
				$url = $button['button-link']['url'];
				$title = $button['button-link']['title'];
				$target = $button['button-link']['target'] ? 'target="' . $button['button-link']['target'] . '"' : '';
				$color = $button['button-color'];
				$ghost = $button['button-ghost'] ? 'button--ghost' : '';
			?>
			<a href="<?php echo $url ?>" <?php echo $target ?> class="button <?php if ($color) : ?>button--<?php echo $color ?><?php endif ?> <?php echo $ghost ?>">
				<?php echo $title ?>
			</a>
		<?php endforeach ?>

	</nav>
<?php endif ?>
