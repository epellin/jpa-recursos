<?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Credentials: true');
//header('Access-Control-Allow-Headers: X-Requested-With');
//To ensure PHP execution is only allowed when it is included as part of the core system.
defined('ABSPATH') or die("Bye bye");

define('JPA_NOMBRE','JPA Recursos');
define('JPA_URL',plugin_dir_url(__FILE__));

$pathAdminFolder = substr(JPA_URL, 0, -7).'/admin';

include(JPA_RUTA . 'includes/class-jpa-resource.php');

/**
* Register and enqueue a custom stylesheet in the WordPress admin.

*/
function jpa_resources_styles() {
	wp_register_style( 'custom_jpa_admin_css', $pathCssFile, false, '1.0.0' );
	wp_enqueue_style( 'custom_jpa_admin_css' );
}
add_action( 'wp_head', 'jpa_resources_styles' ); 

?>

	<div class="wrap">
		<h2><?php _e( JPA_NOMBRE, JPA_NOMBRE );?></h2>

	</div>

	<form id='jpa-add_resource' name='jpa-add_resource' method='post' action='' >
		<div>
			<label>Título del recurso</label>
			<input type="text" name="r_title">
		</div>
		<div>
			<label>Descripción del recurso</label>
			<input type="text" name="r_description">
		</div>
		<div>
			<label>Código shortcode del recurso</label>
			<input type="text" name="r_shortcode">
		</div>
		<div>
			<label>Imagen del recurso</label>
			<input type="file" name="r_img">
		</div>
		<div>
			<label>Código CTA del recurso</label>
			<input type="text" name="r_cta">
		</div>
		<input id='btn_submit' type='submit' value='Añadir recurso'/>
	</form>

	<?php 
		global $data; 
		$data= array("title"=>$_POST['r_title'], "description"=>$_POST['r_description'], "shortcode"=>$_POST['r_shortcode'], "img_url"=>$_POST['r_img'], "cta"=>$_POST['r_cta']); 
	?>

	<script type="text/javascript">
		var form = document.getElementById("jpa-add_resource");

		document.getElementById("btn_submit").addEventListener("click", function () {
			<?php JPA_resource::insert_resource($data);?>
  			
		});
	</script>

		
