<?php
/*
* Plugin Name: jpa-recursos
* Plugin URI: https://www.jeronimopalacios.com
* Description: Plugin para subir recursos a la web y publicarlos a través de shortcodes
* Version: 1.2
* Author: Elena - Jeronimo Palacios & Associates
* Author URI: https://www.jeronimopalacios.com
* License: GPL2
*/

//To ensure PHP execution is only allowed when it is included as part of the core system.
defined('ABSPATH') or die("Bye bye");

define('JPA_RUTA',plugin_dir_path(__FILE__));

$jpa_option = 'recurso';
$jpa_option_value = array();
//$wpdb->prefix ='jpa_';

//Incorporar archivos
include(JPA_RUTA . 'includes/jpa-functions.php');
include(JPA_RUTA.'/includes/jpa-options.php');

//Creamos tabla propia en la BBDD
register_activation_hook( __FILE__, 'jpa_install' );
register_activation_hook( __FILE__, 'jpa_install_data' );



		 
