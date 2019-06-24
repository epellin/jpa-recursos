<?php

//To ensure PHP execution is only allowed when it is included as part of the core system.
defined('ABSPATH') or die("Bye bye");

//To create a table into the DDBB when activating the pluggin.
global $jpa_db_version;
$jpa_db_version = '1.0';

function jpa_install() {
	global $wpdb;
	global $jpa_db_version;
	$wpdb->prefix ='jpa_';
	$table_name = $wpdb->prefix . 'resources';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title tinytext DEFAULT '' NOT NULL,
		description text DEFAULT '' NOT NULL,
		shortcode tinytext DEFAULT '' NOT NULL,
		img_url varchar(2083) DEFAULT '' NOT NULL,
		cta varchar(2083) DEFAULT '' NOT NULL,
		date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jpa_db_version', $jpa_db_version );
}

function jpa_install_data() {
	global $wpdb;
	
	$welcome_name = 'The first JPA resource';
	$welcome_text = 'Congratulations, you just completed the installation!';
	$welcome_cta = 'This will be a Call To Action';
	$welcome_shortcode = 'This would be a cool code';
	
	$wpdb->prefix ='jpa_';
	$table_name = $wpdb->prefix . 'resources';

	$wpdb->insert( 
		$table_name, 
		array(  
			'title' => $welcome_name, 
			'description' => $welcome_text,
			'shortcode' => $welcome_shortcode,
			'cta' => $welcome_cta,
			'date' => current_time( 'mysql' ), 
		) 
	);
}


//Retomar esta funcion cuando consiga crear el front de añadir recurso
function insert_resource(){
	global $wpdb;
	
	$welcome_name = 'The first JPA resource';
	$welcome_text = 'Congratulations, you just completed the installation!';
	$welcome_cta = 'This will be a Call To Action';
	$welcome_shortcode = 'This would be a cool code';
	
	$wpdb->prefix ='jpa_';
	$table_name = $wpdb->prefix . 'resources';

	$wpdb->insert( 
		$table_name, 
		array(  
			'title' => $welcome_name, 
			'description' => $welcome_text,
			'shortcode' => $welcome_shortcode,
			'cta' => $welcome_cta,
			'date' => current_time( 'mysql' ), 
		) 
	);
}

//Retomar esta funcion cuando consiga crear el front de añadir recurso
//add_action('wp', 'insert_resource');


function update_resource(){
	global $wpdb;
	$wpdb->prefix ='jpa_';
	$table_name = $wpdb->prefix . 'resources';
	
	$wpdb->update( 
		$table_name, 
		array(  
			'title' => $welcome_name, 
			'description' => $welcome_text,
			'shortcode' => $welcome_shortcode,
			'cta' => $welcome_cta,
			'date' => current_time( 'mysql' ) 
		) ,
    // Cuando el ID del campo es igual al número 1
    array( 'ID' => 1 )
  );
}
// Ejecutamos nuestro funcion en WordPress
//add_action('wp', 'update_resource');


//Retomar esta funcion cuando consiga crear el front de añadir recurso
function delete_resource(){
	global $wpdb;
	$wpdb->prefix ='jpa_';
	$table_name = $wpdb->prefix . 'resources';
  	
  	$wpdb->delete(
  		$table_name,
		array(
			'id' => 1
		)
	);
}
// Ejecutamos nuestro funcion en WordPress
//add_action('wp', 'delete_resource');
