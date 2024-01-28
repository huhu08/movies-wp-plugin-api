<?php
/**
 * Plugin Name:Movies-plugin-api
 * Versio:0.0.1
 */

register_activation_hook(__FILE__,'wp_movies_api_table');

Function wp_movies_api_table(){
    global $wpdb;
    $table_name=$wpdb->prefix.'movies';
    $sql="CREATE TABLE $table_name (
        id int(9) NOT NULL AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        image_data VARCHAR(255),
        PRIMARY KEY  (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"; 
require_once ABSPATH . '/wp-admin/includes/upgrade.php';
dbDelta($sql);
//$wpdb->query($sql);
    
}
add_action('rest_api_init','movies_register_routes');
function movies_register_routes(){
    register_rest_route(
        'movies-api/v1',
        '/movies/',
        array(
            'method'=>'GET',
            'callback'=>'movies_get',
            'permission_callback'=>'__return_true'
        )
        );
}


function movies_get(){
    global $wpdb;
    $table_name=$wpdb->prefix.'movies';
    $results=$wpdb->get_results('SELECT * FROM $table_name');
    return $results;
}

?>