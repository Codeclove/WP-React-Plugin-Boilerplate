<?php
namespace Test_Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\PostMetas')) {

    /**
     * PostMetas - regitster metas for custom post type object. To show metas in rest output custom post type must support 'Custom-fields'.
     */
    class PostMetas
    {

        public $metas = array(

            'test_meta' => array(
                'type' => 'string',
                'default' => 'modro-cervena',
            ),
            'test_meta_number' => array(
                'type' => 'number',
                'default' => 0,
            ),

            'test_meta_with_schema' => array(
                'type' => 'array',
                'show_in_rest' => array(
                    'schema' => array(
                        'items' => array(
                            'type' => 'string',

                        ),
                    ),
                ),
            ),
       );
        public function __construct()
        {
            foreach ($this->metas as $meta_key => $meta_args) {

                $meta_args['single'] = true;
                if (!array_key_exists('show_in_rest', $meta_args)) {
                    $meta_args['show_in_rest'] = true;
                }

                register_meta('post', $meta_key, $meta_args);
            }

        }

    }
}
