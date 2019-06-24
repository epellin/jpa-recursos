<?php

defined('ABSPATH') or die("Bye bye");

final class JPA_resource {

	//Id of resource
	public $id;

	//Title of the resource
	public $title = '';

	//Description of the resource
	public $description = '';

	//Shortcode of the resource
	public $shortcode = '';

	//Image's URL of the resource
	public $img_url = '';

	//CTA shortcode form HubSpot for downloading the resource
	public $cta = '';

	//Creation or modification date of the resource
	public $date = '0000-00-00 00:00:00';

	/**
	 * Constructor.
	 *
	 * @param JPA_resource|object $resource Post object.
	 */
	public function __construct( $resource ) {
		
		foreach ( $resource  as $key => $value ) {
			$this->$key = $value;
		}
	}

	/**
	 * Retrieve JPA_resource instance.
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 *
	 * @param int $resource_id Resource id.
	 * @return JPA_resource|false JPA_resource object, false otherwise.
	 */
	public static function get_instance( $resource_id ) {
		global $wpdb;
		$wpdb->prefix ='jpa_';
		$table_name = $wpdb->prefix . 'resources';

		$resource_id = (int) $resource_id;
		if ( ! $resource_id ) {
			return false;
		}

		$_resource = $wpdb->get_results(
					"
					SELECT *
					FROM $table_name
					WHERE id = $resource_id
				", ARRAY_A
				);

		$_resource = $_resource[0];

		if ( ! $_resource ) {
				return false;
			}
			
		return new JPA_resource( $_resource );
	}

	/**
	 * Retrieve JPA_resource instance.
	 *
	 * @global wpdb $wpdb WordPress database abstraction object.
	 * @return $arrayResources|false $arrayResources array, false otherwise.
	 */
	public static function get_instances() {
		global $wpdb;
		$wpdb->prefix ='jpa_';
		$table_name = $wpdb->prefix . 'resources';

		$count_query = "select count(*) from $table_name";
    	$num = $wpdb->get_var($count_query);
    	


		if ( ! $num ) {
			die('No hay recursos disponibles');
		} else {
			$arrayResources = array();
			for ($i = 1; $i <= $num; $i++) {
				$resourceObject = JPA_resource::get_instance($i);
			    array_push($arrayResources, $resourceObject );
			}
			return $arrayResources;
		}
	}

	/**
	 * Getter.
	 *
	 * @param string $key Key to get.
	 * @return mixed
	 */
	public function __get( $key ) {

		if ( 'id' == $key ) {
			return $this->id;
		}
		if ( 'title' == $key ) {
			return $this->title;
		}
		if ( 'description' == $key ) {
			return $this->description;
		}
		if ( 'shortcode' == $key ) {
			return $this->shortcode;
		}
		if ( 'img_url' == $key ) {
			return $this->img_url;
		}
		if ( 'cta' == $key ) {
			return $this->cta;
		}
		if ( 'date' == $key ) {
			return $this->date;
		}
	}

	/**
	 * Convert object to array.
	 *
	 * @return array Object as array.
	 */
	public function to_array() {
		$resource = get_object_vars( $this );

		foreach ( array( 'id', 'title', 'description', 'shortcode', 'img_url', 'cta', 'date' ) as $key ) {
			$resource[ $key ] = $this->__get( $key );
		}

		return $resource;
	}

	/**
	 * Convert object to array.
	 *
	 * @return array Object as array.
	 */
	public static function insert_resource($arrayData){
		global $wpdb;
		$wpdb->prefix ='jpa_';
		$table_name = $wpdb->prefix . 'resources';

		$title = $arrayData['title'] ? $arrayData['title'] : '';
		$description = $arrayData['description'] ? $arrayData['description'] : '';
		$shortcode = $arrayData['shortcode'] ? $arrayData['shortcode']  : '';
		$img_url = $arrayData['img_url'] ? $arrayData['img_url'] : '';
		$cta = $arrayData['cta'] ? $arrayData['cta'] : '';

		$wpdb->insert( 
			$table_name, 
			array(  
				'title' => $title, 
				'description' => $description,
				'shortcode' => $shortcode,
				'img_url' => $img_url,
				'cta' => $cta,
				'date' => current_time( 'mysql' ), 
			) 
		);
	}
}
