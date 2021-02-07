<?php

/**
 * The search form template
 * 
 * @package Abbrivio
 */

// Generate a unique ID for each form
$unique_id = abbrivio_get_unique_id('search-form-');
// Aria label
$form_aria_label = !empty($args['label']) ? 'aria-label="' . esc_attr($args['label']) . '"' : '';

?>
<form role="search" <?php echo $form_aria_label; ?> method="get" class="d-flex align-items-center" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="m-0">
        <input type="search" id="<?php echo esc_attr($unique_id); ?>" class="form-control me-2 mb-0" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'abbrivio'); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
    </label>
    <button class="btn btn-outline-success" type="submit"><?php echo esc_attr_x('Search', 'submit button', 'abbrivio'); ?></button>
</form>