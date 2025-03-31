<?php
// Prevent direct access
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete stored options
delete_option( 'cpsr_career_paths' );

// Clean up transients if any were used
global $wpdb;
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'cpsr_%'" );
?>
