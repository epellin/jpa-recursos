<?php

/**
 * Fired when the plugin is uninstalled.
 * Plugin URI: https://www.jeronimopalacios.com
 * @since      1.2
 * @package    jpa-recursos
 */

    defined('ABSPATH') or die("Bye bye");

    //Por seguridad. Nos aseguramos de que es WordPress el que está ejecutando este archivo.
	if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
		exit;
	}

	if ( ! current_user_can( 'install_plugins' ) ) {
		exit;
	}
    
	function jpa_my_plugin_remove_database() {
	     global $wpdb;
	     $wpdb->prefix ='jpa_';
	     $table_name = $wpdb->prefix . 'resources';
	     $sql = "DROP TABLE IF EXISTS $table_name";
	     $wpdb->query($sql);
	     delete_option("jpa_db_version");
	} 

	register_deactivation_hook( __FILE__, 'jpa_my_plugin_remove_database');