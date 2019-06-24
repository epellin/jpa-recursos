<?php

//To ensure PHP execution is only allowed when it is included as part of the core system.
defined('ABSPATH') or die("Bye bye");

define('JPA_NOMBRE','JPA Recursos');
define('JPA_RUTA',plugin_dir_path(__FILE__));
define('JPA_URL',plugin_dir_url(__FILE__));
define('WP_DEBUG', true);
$postCategory = 'Agile';
$pathCssFile = substr(JPA_URL, 0, -7).'/assets/css/jpa-style-resources.css';
//$pathCssFile = JPA_RUTA.'assets/css/jpa-style-resources.css';
$pathImgFolder = substr(JPA_URL, 0, -7).'/assets/images';
$pathAdminFolder = substr(JPA_URL, 0, -7).'/admin';
$pathAdminFolder = JPA_RUTA .'admin';
//$pathAddFile = plugins_url( '/admin/jpa-add_resource.php', dirname(__FILE__) );

include(JPA_RUTA . 'includes/class-jpa-resource.php');

if (! current_user_can ('manage_options')) wp_die (__ ('No tienes suficientes permisos para acceder a esta página.'));
?>
<style>
	table, tr, td, th {
		border: 1px solid #2c2c2c;
	}
	table{
		border-collapse: collapse;
		margin: 2em auto;
		width: 95%;
	}
	td, th {
		padding: 0.5em;
	}
	img {
		margin: auto;
		width: 2em;
		height: auto;
		padding: 0 .5em;
	}
	input[type=submit]{
		padding: .2em .5em;
		background-color: #57C1ED;
		color: white;
		border: 1px solid #57C1ED;
	}
</style>
	<?php

		/**
		 * Register and enqueue a custom stylesheet in the WordPress admin.
		 
		function jpa_resources_styles() {
		        wp_register_style( 'custom_jpa_admin_css', $pathCssFile, false, '1.0.0' );
		        wp_enqueue_style( 'custom_jpa_admin_css' );
		}
		add_action( 'wp_head', 'jpa_resources_styles' ); */
	?>

	<div class="wrap">
		<h2><?php _e( JPA_NOMBRE, JPA_NOMBRE ); echo "<br>URL archivo css: ".$pathCssFile ?></h2>
		<p>Bienvenido a la configuración del plugin de Recursos de Jeronimo Palacios & Associates</p>
	</div>
	<form name='recursos' method='post' action=<?php $pathAdminFolder."/jpa-add_resource.php"?>>
		<input type='submit' value='Añadir recurso'/>
	</form>

  <table>
  	<tr>
  		<th>id</th>
  		<th>Titulo</th>
  		<th>Shortcode</th>
  		<th>CTA</th>
  		<th>Acciones</th>
  	</tr>
  <?php

	$list_all_resources = JPA_resource::get_instances();

	if (! $list_all_resources){
		die("No hay recursos en la base de datos.");
	} else {
		foreach ($list_all_resources as $resource_object){ ?>
			<tr>
				<td><?php echo $resource_object->__get('id'); ?></td>
				<td><?php echo $resource_object->__get('title'); ?></td>
				<td><?php echo $resource_object->__get('shortcode'); ?></td>
				<td><?php echo $resource_object->__get('cta'); ?></td>
				<td><a href='./jpa-edit_resource.php'><img src=<?php echo $pathImgFolder.'/edit_icon.png'?> tittle='botón para editar recurso'/></a><a href='./jpa-delete_resource.php'><img src=<?php echo $pathImgFolder.'/delete_icon.png'?> tittle='botón para eliminar recurso'/></a></td>
			</tr>
			<?php
		}	
	}
	//util?
	wp_reset_query();
	
?>
</table>