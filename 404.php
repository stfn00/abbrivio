<?php

/**
 * 404 page
 *
 * @package Abbrivio
 */

get_header();

	// Page Heading
	get_template_part( 'template-parts/components/page-headings/page-heading', 'base', [
		'title' => __('404 - Not found', 'abbrivio'),
    ]);

	?>
	<!-- Entry content -->
    <section class="entry-content">
        <div class="container mt-5 mb-5">
            <div class="row row-cols-1 row-cols-md-3">
                <p><?php esc_html_e('It seems that we cannot find what you are looking for.', 'abbrivio'); ?></p>
            </div>
        </div>
    </section>
	<?php

get_footer();
