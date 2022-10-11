<?php
namespace TestPlugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\TestPlugin\\TestPlugin_Post_Metas')) {

    class TestPlugin_Post_Metas
    {

        public static $metas = array(

            'test_meta' => array(
                'type' => 'string',
                'default' => 'default-value',
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
        public static function init()
        {
            foreach (self::$metas as $meta_key => $meta_args) {

                $meta_args['single'] = true;
                if (!array_key_exists('show_in_rest', $meta_args)) {
                    $meta_args['show_in_rest'] = true;
                }

                register_meta('post', $meta_key, $meta_args);
            }

        }

    }
}
