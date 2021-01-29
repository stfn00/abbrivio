<?php

/**
 * Template for post entry header
 *
 * @package Abbrivio
 */

$the_post_id = get_the_ID();
$hide_title = get_post_meta($the_post_id, '_hide_page_title', true);
$heading_class = (!empty($hide_title) && 'yes' === $hide_title) ? 'hide d-none' : '';

$has_post_thumbnail = get_the_post_thumbnail($the_post_id);

?>

<!-- Entry Header -->
<section class="entry-header">
	<?php
	// Title
	if (is_single() || is_page()) {
		printf(
			'<h1 class="page-title text-dark mt-5 mb-5 %1$s">%2$s</h1>',
			esc_attr($heading_class),
			wp_kses_post(get_the_title())
		);
	} else {
		printf(
			'<h2 class="entry-title mb-3"><a class="text-dark" href="%1$s">%2$s</a></h2>',
			esc_url(get_the_permalink()),
			wp_kses_post(get_the_title())
		);
	}

	// Featured image
	if ($has_post_thumbnail) {
		?>
		<div class="entry-image mb-3">
			<a href="<?php echo esc_url(get_permalink()); ?>">
				<?php abbrivio_post_thumbnail($the_post_id, $size = 'abbrivio-large', $type = 'img'); ?>
			</a>
		</div>
		<?php
	}
	?>
</section>