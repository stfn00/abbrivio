<?php

/**
 * Template part for displaying Card of Posts
 *
 * @package Abbrivio
 */

?>

<!-- Card -->
<div class="col">
    <div class="card">
        <?php
        if ( has_post_thumbnail() ) {
            the_post_custom_thumbnail(
                get_the_ID(),
                'abbrivio-small',
                [
                    'sizes' => '(max-width: 350px) 350px, 233px',
                    'class' => 'w-100',
                ]
            );
        } else {
            ?>
            <img src="https://via.placeholder.com/510x340" class="w-100" alt="Card image cap">
            <?php
        }
        ?>
        <div class="card-body">
            <?php the_title('<h3 class="card-title">', '</h3>'); ?>
            <?php abbrivio_the_excerpt(); ?>
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary">
                <?php esc_html_e('View More', 'abbrivio'); ?>
            </a>
        </div>
    </div>
</div>