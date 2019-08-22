<section id="page">

	<?php while (have_posts()) : the_post() ?>
		<header>

			<h1><?php the_title() ?></h1>

			<?php if ($video = get_field('video-hero-code')) : ?>
				<div class="video-hero">
					<div class="video-hero__video">
						<?php echo sleek_add_youtube_args($video, [
							'autoplay' => 1,
							'controls' => 0,
							'showinfo' => 0,
							'loop' => 1,
							'mute' => 1,
							'playlist' => sleek_get_youtube_id($video), # Needed by loop
							'iv_load_policy' => 3 # Hide annotations
						]) ?>
					</div>
				</div>
			<?php endif ?>

			<?php if (has_post_thumbnail()) : ?>
				<figure>
					<?php the_post_thumbnail('large') ?>
				</figure>
			<?php endif ?>

			<?php the_excerpt() ?>

		</header>

		<?php if (get_field('modules_aside_content') and !post_password_required()) : ?>
			<div>

				<article>

					<?php the_content() ?>
					<?php wp_link_pages() ?>

				</article>

				<aside>

					<?php SleekACF::renderModules('aside_content') ?>

				</aside>

			</div>
		<?php else : ?>
			<article>

				<?php the_content() ?>
				<?php wp_link_pages() ?>

			</article>
		<?php endif ?>
	<?php endwhile ?>

</section>
