<?php
namespace TestPlugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('\\TestPlugin\\WordpressSubMenu')) {

    class WordPressSubMenu extends WordPressMenu
    {

        public function __construct($options, WordPressMenu $parent)
        {
            parent::__construct($options);

            $this->parent_id = $parent->settings_id;
        }

    }
}
