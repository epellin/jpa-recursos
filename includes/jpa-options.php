<?php

//To ensure PHP execution is only allowed when it is included as part of the core system.
defined('ABSPATH') or die("Bye bye");

define('JPA_NOMBRE','JPA Recursos');
define('JPA_RUTA',plugin_dir_path(__FILE__));

// Top level menu del plugin
function jpa_menu_administrator()
{
    add_menu_page(JPA_NOMBRE,JPA_NOMBRE,'manage_options',JPA_RUTA . '/admin/jpa-configuration.php');
    add_submenu_page(JPA_RUTA . '/admin/jpa-configuration.php','Add resource','Add resource','manage_options',JPA_RUTA . '/admin/jpa-add_resource.php');
}

// El hook admin_menu ejecuta la funcion rai_menu_administrador
add_action( 'admin_menu', 'jpa_menu_administrator' );