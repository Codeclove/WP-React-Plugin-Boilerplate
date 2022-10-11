<?php
namespace TestPlugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\TestPlugin\\TestPlugin_Settings')) {

    class TestPlugin_Settings
    {
        public static function register_settings()
        {
            // Register a new setting for "TestPlugin" page.
            register_setting('test-plugin', 'TestPlugin_options');

            // Register a new section in the "TestPlugin" page.
            add_settings_section(
                'TestPlugin_section_name',
                'Názov sekcie',
                function ($args) {require TestPlugin_DIR . 'admin/partials/test-plugin-settings-section.php';},
                'test-plugin'
            );

            add_settings_field(
                'TestPlugin_input_field',
                'Input pole sekcie',
                function ($args) {require TestPlugin_DIR . 'admin/partials/test-plugin-settings-input-field.php';},
                'test-plugin',
                'TestPlugin_section_name',
                array(
                    'label_for' => 'TestPlugin_input_field',
                    'class' => 'TestPlugin_row',
                )
            );

            add_settings_field(
                'TestPlugin_select_field',
                'Select pole sekcie',
                function ($args) {require TestPlugin_DIR . 'admin/partials/test-plugin-settings-select-field.php';},
                'test-plugin',
                'TestPlugin_section_name',
                array(
                    'label_for' => 'TestPlugin_select_field',
                    'class' => 'TestPlugin_row',
                )
            );
        }
    }
}
