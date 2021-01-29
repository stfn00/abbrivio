<?php

/**
 * Single post template
 *
 * @package Abbrivio
 */

// Show Author Box
$show_author_box = get_post_meta(get_the_ID(), 'abbrivio_show_author_box', true);

get_header();

if ( have_posts() ) {

	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-8">
				<?php
				while ( have_posts() ) {
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					// Author Box
					if ($show_author_box == 'true')
						get_template_part( 'template-parts/components/blog/author-box' );

					?>
					<!-- Navigation links -->
					<div class="prev-link"><?php previous_post_link(); ?></div>
					<div class="next-link"><?php next_post_link(); ?></div>
					<?php
				}
				?>
			</div>
			<div class="col-sm-12 col-md-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<?php
			
} else {
    // Content none
    get_template_part( 'template-parts/content-none' );
}

get_footer();
