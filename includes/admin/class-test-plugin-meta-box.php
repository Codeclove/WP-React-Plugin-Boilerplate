<?php
namespace Test_Plugin;

/**
 * File where we define CPT, Taxonomies etc.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\MetaBox')) {

    class Meta_Box
    {

        private $post_types = ['post'];
        private $metabox_title = 'React Metabox Title';

                
        /**
         * __construct
         *
         * @param  array $post_types
         * @param  string $metabox_title
         * @return void
         */
        function __construct($post_types, $metabox_title)
        {
            $this->post_types = $post_types;
            $this->metabox_title = $metabox_title;
        }

        /**
         * Set up and add the meta box.
         */
        public function add()
        {
            $screens = $this->post_types;
            foreach ($screens as $screen) {
                add_meta_box(
                    $screen . '_box_id', // Unique ID
                    $this->metabox_title, // Box title
                    [$this, 'html'], // Content callback, must be of type callable
                    $screen // Post type
                );
            }
        }

        /**
         * Display the meta box HTML to the user.
         *
         * @param \WP_Post $post   Post object.
         */
        public function html($post)
        {
            require_once plugin_dir_path(dirname(dirname(__FILE__))) . 'admin/partials/test-plugin-cpt-metabox.php';
        }
    }
}
