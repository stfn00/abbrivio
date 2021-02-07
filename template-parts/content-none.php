<?php

/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Abbrivio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('no-result not-found mb-5'); ?>>

	<?php
	// Page Heading
	get_template_part( 'template-parts/components/page-headings/page-heading', 'base', [
		'title' => __('Nothing Found', 'abbrivio')
	]);
	?>

	<!-- Entry content -->
	<section class="entry-content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10">
					<?php
					// Blog page
					if (is_home() && current_user_can('publish_posts')) {
						?>
						<p>
							<?php
							printf(
								wp_kses(
									__('Ready to publish your first post? <a href="%s">Get started here</a>', 'abbrivio'),
									[
										'a' => [
											'href' => []
										]
									]
								),
								esc_url(admin_url('post-new.php'))
							)
							?>
						</p>
						<?php
					// Search page
					} elseif (is_search()) {
						?>
						<p><?php esc_html_e('Sorry but nothing matched your search item. Please try again with some different keywords', 'abbrivio'); ?></p>
						<?php
						// Search form
						get_search_form();
					// Base
					} else {
						?>
						<p><?php esc_html_e('It seems that we cannot find what you are looking for. Perhaps search can help', 'abbrivio'); ?></p>
						<?php
						// Search form
						get_search_form();
					}
					?>
				</div>
			</div>
		</div>
	</section>

</article>