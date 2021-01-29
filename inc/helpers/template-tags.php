<?php

/**
 * Custom template tags for the theme
 *
 * @package Abbrivio
 */



/**
 * Displays an optional post thumbnail
 */
function abbrivio_post_thumbnail($attachment_id, $size = 'abbrivio-medium', $type = 'img')
{
	if (is_single() && $type == 'img') {

		if (post_password_required() || is_attachment() || !has_post_thumbnail())
			return;

		?>
		<div class="single-post-thumbnail">
			<picture>
				<source media="(min-width: 801px) and (max-width: 1050px)" data-srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), "abbrivio-large"); ?>">
				<source media="(min-width: 401px) and (max-width: 800px)" data-srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), "abbrivio-medium"); ?>">
				<source media="(max-width: 400px)" data-srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), "abbrivio-small"); ?>">
				<img data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), "abbrivio-large"); ?>" class="lazy">
			</picture>
		</div>
		<?php

	} else {

		if (empty($attachment_id))
			return;

		$attachment_src = wp_get_attachment_image_src($attachment_id, $size);

		if ($type == 'url') {

			return $attachment_src[0];

		} else if ($type == 'img') {

			?>
			<div class="single-post-thumbnail">
				<picture>
					<source media="(min-width: 801px) and (max-width: 1050px)" data-srcset="<?php echo wp_get_attachment_image_src($attachment_id, "abbrivio-large")[0]; ?>">
					<source media="(min-width: 401px) and (max-width: 800px)" data-srcset="<?php echo wp_get_attachment_image_src($attachment_id, "abbrivio-medium")[0]; ?>">
					<source media="(max-width: 400px)" data-srcset="<?php echo wp_get_attachment_image_src($attachment_id, "abbrivio-small")[0]; ?>">
					<img data-src="<?php echo wp_get_attachment_image_src($attachment_id, "abbrivio-large")[0]; ?>" class="lazy">
				</picture>
			</div>
			<?php
		}
	}
}



/**
 * Gets the thumbnail with Lazy Load
 * Should be called in the WordPress Loop
 */
function get_the_post_custom_thumbnail($post_id, $size = 'abbrivio-small', $additional_attributes = [])
{
	$custom_thumbnail = '';

	if (null === $post_id) {
		$post_id = get_the_ID();
	}

	if (has_post_thumbnail($post_id)) {
		$default_attributes = [
			'loading' => 'lazy'
		];

		$attributes = array_merge($additional_attributes, $default_attributes);

		$custom_thumbnail = wp_get_attachment_image(
			get_post_thumbnail_id($post_id),
			$size,
			false,
			$attributes
		);
	}

	return $custom_thumbnail;
}



/**
 * Renders Custom Thumbnail with Lazy Load
 */
function the_post_custom_thumbnail($post_id, $size = 'abbrivio-small', $additional_attributes = [])
{
	echo get_the_post_custom_thumbnail($post_id, $size, $additional_attributes);
}



/**
 * Prints HTML with meta information for the current post-date/time
 */
function abbrivio_posted_on()
{
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	// Post is modified ( when post published time is not equal to post modified time )
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)),
		esc_attr(get_the_date()),
		esc_attr(get_the_modified_date(DATE_W3C)),
		esc_attr(get_the_modified_date())
	);

	$posted_on = sprintf(
		esc_html_x('Posted on %s', 'post date', ABBRIVIO_THEME_SLUG),
		'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}



/**
 * Prints HTML with meta information for the current author
 */
function abbrivio_posted_by()
{
	$byline = sprintf(
		esc_html_x(' by %s', 'post author', ABBRIVIO_THEME_SLUG),
		'<span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
	);

	echo '<span class="byline text-secondary">' . $byline . '</span>';
}



/**
 * Get the trimmed version of post excerpt
 *
 * This is for modifing manually entered excerpts
 * NOT automatic ones WordPress will grab from the content
 *
 * It will display the first given characters ( e.g. 100 ) characters of a manually entered excerpt
 * but instead of ending on the nth( e.g. 100th ) character
 * it will truncate after the closest word
 */
function abbrivio_the_excerpt($trim_character_count = 0)
{
	if (!has_excerpt() || 0 === $trim_character_count) {
		the_excerpt();
		return;
	}

	$excerpt = wp_strip_all_tags(get_the_excerpt());
	$excerpt = substr($excerpt, 0, $trim_character_count);
	$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));

	echo $excerpt . ' ...';
}



/**
 * Filter the "read more" excerpt string link to the post
 */
function abbrivio_excerpt_more($more = '')
{

	if (!is_single()) {
		$more = sprintf(
			'<a class="abbrivio-read-more text-white" href="%1$s"><button class="mt-3 btn btn-info">%2$s</button></a>',
			get_permalink(get_the_ID()),
			__('Read more', ABBRIVIO_THEME_SLUG)
		);
	}

	return $more;
}



/**
 * Abbrivio Pagination
 */
function abbrivio_pagination()
{

	$allowed_tags = [
		'span' => [
			'class' => []
		],
		'a' => [
			'class' => [],
			'href' => [],
		]
	];

	$args = [
		'before_page_number' => '<span class="btn border border-secondary mr-2 mb-2">',
		'after_page_number' => '</span>',
	];

	printf('<nav class="abbrivio-pagination clearfix">%s</nav>', wp_kses(paginate_links($args), $allowed_tags));
}
