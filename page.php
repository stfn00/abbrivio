<?php

/**
 * Page template
 *
 * @package Abbrivio
 */

get_header();

if (have_posts()) {

    // Dynamic page content
    while (have_posts()) {
        the_post();

        get_template_part('template-parts/content', 'page');
    }
} else {
    // Content none
    get_template_part('template-parts/content-none');
}

get_footer();
