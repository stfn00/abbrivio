<?php

/**
 * Search page
 *
 * @package Abbrivio
 */

get_header();

if (have_posts()) {

	// Page Heading
	get_template_part( 'template-parts/components/page-headings/page-heading', 'base', [
		'title' => __('Search for ', ABBRIVIO_THEME_SLUG) . '<span>' . sanitize_text_field($_GET['s']) . '</span>',
    ]);

    ?>
    <!-- Posts -->
    <section class="container mt-5 mb-5">
		<div class="row row-cols-1 row-cols-md-3">
			<?php
			// Dynamic page content
			while (have_posts()) {
				the_post();

				get_template_part('template-parts/components/cards/card', get_post_type());
			}
			?>
		</div>
	</section>
    
    <!-- Pagination links -->
    <section class="container mb-5">
        <?php abbrivio_pagination(); ?>
    </section>
    <?php

} else {
    // Content none
    get_template_part('template-parts/content-none');
}

get_footer();
