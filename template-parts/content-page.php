<?php

/**
 * Content Page template
 *
 * @package Abbrivio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('abbrivio-page  mb-5'); ?>>

	<?php
	// Page Heading
	get_template_part( 'template-parts/components/page-headings/page-heading', 'base', [
		'title' => get_the_title()
	]);
	?>

	<!-- Entry content -->
	<section class="entry-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- Entry footer -->
	<section class="entry-footer">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10">
					<?php
					// Edit post link
					edit_post_link( esc_html__('Edit', ABBRIVIO_THEME_SLUG), '<div class="edit-link">', '</div>' );
					
					// Navigation links
					if ( !is_home() ) {
						wp_link_pages( [
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', ABBRIVIO_THEME_SLUG),
							'after'  => '</div>',
						]);
					}
					?>
				</div>
			</div>
		</div>
	</section>

</article>