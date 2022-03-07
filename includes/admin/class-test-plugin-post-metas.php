<?php
namespace TestPlugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\TestPlugin\\PostMetas')) {

    /**
     * PostMetas - regitster metas for custom post type object. To show metas in rest output custom post type must support 'Custom-fields'.
     */
    class PostMetas
    {
        private $object_type = 'post';
        private $meta_args = array( // Validate and sanitize the meta value.
            // Note: currently (4.7) one of 'string', 'boolean', 'integer',
            // 'number' must be used as 'type'. The default is 'string'.
            'type' => 'string',
            // Custom post type
            'object_subtype' => '',
            // Shown in the schema for the meta key.
            'description' => '',
            // Return a single value of the type.
            'single' => true,
            // Show in the WP REST API response. Default: false.
            'show_in_rest' => true,
        );

        /**
         * __construct
         *
         * @param  mixed $post_type
         * @param  mixed $meta_desc
         * @return void
         */
        public function __construct($post_type, $meta_desc)
        {

            $this->meta_args['object_subtype'] = $post_type;
            $this->meta_args['description'] = $meta_desc;

        }

        /**
         * register_metas
         *
         * @param  mixed $args - array of arguments for single meta
         * @return void
         */
        public function register_metas($args)
        {

            $meta_args = $this->meta_args;

            foreach ($args as $single_meta_args) {
                $meta_args['type'] = $single_meta_args['type'];
                $meta_key = $single_meta_args['meta_key'];
                register_meta($this->object_type, $meta_key, $meta_args);
            }

        }
    }

}
