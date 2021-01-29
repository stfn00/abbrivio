<?php

/**
 * Posts Carousel
 *
 * @package Abbrivio
 */

$posts_query = new \WP_Query([
	'posts_per_page' => 5,
	'post_type' => 'post',
	'update_post_meta_cache' => false,
	'update_post_term_cache' => false,
]);

?>

<!-- Slider Posts -->
<section class="mt-5 mb-5">
	<div class="container">
		<div class="abbrivio-slider">
			<?php
			if ($posts_query->have_posts()) {

				while ($posts_query->have_posts()) {

					$posts_query->the_post();

					?>
					<!-- Slide -->
					<div class="abbrivio-slider__slide">
						<?php get_template_part( 'template-parts/components/cards/card', get_post_type() ); ?>
					</div>
					<?php
				}
			}

			wp_reset_postdata();
			?>
		</div>
	</div>
</section>