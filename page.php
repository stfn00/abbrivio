<?php

/**
 * Page template
 *
 * @package Abbrivio
 */

// Show Author Box
$show_author_box = get_post_meta(get_the_ID(), 'abbrivio_show_author_box', true);

get_header();

if (have_posts()) {

    // Dynamic page content
    while (have_posts()) {
        the_post();

        get_template_part('template-parts/content', 'page');

        // Author Box
        if ($show_author_box == 'true')
            get_template_part( 'template-parts/components/blog/author-box' );
    }
} else {
    // Content none
    get_template_part('template-parts/content-none');
}

get_footer();
