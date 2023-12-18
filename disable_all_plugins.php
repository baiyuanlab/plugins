<?php
/*
Plugin Name: Disable All Plugins
Description: This plugin disables all other plugins and reactivates itself.
Version: 1.0
Author: Your Name
*/

// Function to disable all other plugins
function disable_all_plugins() {
    $active_plugins = get_option('active_plugins');
    
    foreach ($active_plugins as $plugin) {
        // Exclude the current plugin from deactivation
        if (plugin_basename(__FILE__) !== $plugin) {
            deactivate_plugins($plugin);
        }
    }
    
    // Reactivate this plugin
    activate_plugin(plugin_basename(__FILE__));
}
add_action('admin_init', 'disable_all_plugins');
