<?php if ($apiKey = get_theme_mod('google_maps_api_key')) : ?>
	<section id="google-map">

		<?php if ($data['google-map-title'] or $data['google-map-description']) : ?>
			<header>

				<?php if ($data['google-map-title']) : ?>
					<h2><?php echo $data['google-map-title'] ?></h2>
				<?php endif ?>

				<?php echo $data['google-map-description'] ?>

			</header>
		<?php endif ?>

		<div class="google-map" data-lat="<?php echo $data['google-map']['lat'] ?>" data-lng="<?php echo $data['google-map']['lng'] ?>">
			<img src="https://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&amp;center=<?php echo $data['google-map']['lat'] ?>,<?php echo $data['google-map']['lng'] ?>&amp;markers=<?php echo $data['google-map']['lat'] ?>,<?php echo $data['google-map']['lng'] ?>&amp;zoom=14&amp;size=600x400&amp;key=<?php echo $apiKey ?>">
		</div>

	</section>
<?php endif ?>
