<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       marek@codeli.sk
 * @since      1.0.0
 *
 * @package    Test_Plugin
 * @subpackage Test_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- When React is used -->
<div id="test-plugin-admin-simple"></div> 

<?php

// check user capabilities
if ( ! current_user_can( 'edit_others_posts' ) ) {
    return;
}

// add error/update messages

// check if the user have submitted the settings
// WordPress will add the "settings-updated" $_GET parameter to the url
if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
    add_settings_error( 'test_plugin_messages', 'test_plugin_message', 'Nastavenie boli uložené', 'updated' );
}

// show error/update messages
settings_errors( 'test_plugin_messages' );
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "test-plugin"
        settings_fields( 'test-plugin' );
        // output setting sections and their fields
        // (sections are registered for "test-plugin", each field is registered to a specific section)
        do_settings_sections( 'test-plugin' );
        // output save settings button
        submit_button( 'Uložiť nastavenia' );
        ?>
    </form>
</div>
