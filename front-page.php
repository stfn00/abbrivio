<?php

/**
 * Front page template
 *
 * @package abbrivio
 */

get_header();

if (have_posts()) {

	// Dynamic page content
	while (have_posts()) {
		the_post();

		get_template_part('template-parts/content', get_post_type());
	}
} else {
	// Content none
	get_template_part('template-parts/content-none');
}

// Posts slider
get_template_part('template-parts/components/sliders/slider', 'posts');

get_footer();
