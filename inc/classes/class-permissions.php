<?php

/**
 * Set generic permission for website
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

class Permissions
{
    use Singleton;

    private $theme_options;

    protected function __construct()
    {
        // Get Theme options
        $this->theme_options = abbrivio_get_options();

        // load class
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        /**
         * Actions
         */
        // Restrict access to media library by user
        if ($this->theme_options['abbrivio-restrict-media-access-non-admin-editor'])
            add_filter('ajax_query_attachments_args', [$this, 'restrict_media_library']);
    }



    /**
     * Restrict access to media library by user
     */
    public function restrict_media_library($query)
    {
        $user_id = get_current_user_id();

        if ($user_id && !abbrivio_user_has_role(array('administrator', 'editor'))) {
            $query['author'] = $user_id;
        }

        return $query;
    }
}
