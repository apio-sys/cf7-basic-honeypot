<?php
/**
 * Uninstall script for Contact Form 7 Simple Honeypot
 * 
 * This file is called when the plugin is deleted via the WordPress admin.
 * It removes all plugin data from the database.
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
delete_option('cf7_simple_honeypot_settings');

// For multisite installations, delete options from all sites
if (is_multisite()) {
    global $wpdb;
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    $original_blog_id = get_current_blog_id();
    foreach ($blog_ids as $blog_id) {
        switch_to_blog($blog_id);
        delete_option('cf7_simple_honeypot_settings');
    }
    switch_to_blog($original_blog_id);
}
