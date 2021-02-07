<?php

/**
 * Template for entry content
 *
 * To be used inside WordPress The Loop
 *
 * @package Abbrivio
 */

?>

<!-- Entry Content -->
<section class="entry-content mt-5 mb-5">
	<?php
	if (is_single()) {

		the_content(
			sprintf(
				wp_kses(
					__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'abbrivio'),
					[
						'span' => [
							'class' => []
						]
					]
				),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			)
		);

		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'abbrivio'),
				'after'  => '</div>',
			]
		);

	} else {
		abbrivio_the_excerpt(200);
		printf('<br>');
		echo abbrivio_excerpt_more();
	}
	?>
</section>