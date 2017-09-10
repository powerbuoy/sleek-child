<?php if ($data['buttons']) : ?>
	<nav class="buttons">

		<?php foreach ($data['buttons'] as $button) : ?>
			<?php
				$url = $button['button-link']['url'];
				$title = $button['button-link']['title'];
				$target = $button['button-link']['target'] ? 'target="' . $button['button-link']['target'] . '"' : '';
				$color = $button['button-color'];
				$ghost = $button['button-ghost'] ? 'button--ghost' : '';
				$icon = $button['button-icon'];
			?>
			<a href="<?php echo $url ?>"
				<?php echo $target ?>
				class="button button--<?php echo $color ?> <?php echo $ghost ?> <?php if ($icon) : ?>icon-<?php echo $icon ?> icon--after<?php endif ?>">
				<?php echo $title ?>
			</a>
		<?php endforeach ?>

	</nav>
<?php endif ?>
