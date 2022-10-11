<?php
namespace Test_Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\Test_Plugin\\Test_Plugin_Settings')) {

    class Test_Plugin_Settings
    {
        public static function register_settings()
        {
            // Register a new setting for "test_plugin" page.
            register_setting('test-plugin', 'test_plugin_options');

            // Register a new section in the "test_plugin" page.
            add_settings_section(
                'test_plugin_section_name',
                'Názov sekcie',
                function ($args) {require plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test-plugin-settings-section.php';},
                'test-plugin'
            );

            add_settings_field(
                'test_plugin_input_field',
                'Input pole sekcie',
                function ($args) {require plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test-plugin-settings-input-field.php';},
                'test-plugin',
                'test_plugin_section_name',
                array(
                    'label_for' => 'test_plugin_input_field',
                    'class' => 'test_plugin_row',
                )
            );

            add_settings_field(
                'test_plugin_select_field',
                'Select pole sekcie',
                function ($args) {require plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test-plugin-settings-select-field.php';},
                'test-plugin',
                'test_plugin_section_name',
                array(
                    'label_for' => 'test_plugin_select_field',
                    'class' => 'test_plugin_row',
                )
            );
        }
    }
}
