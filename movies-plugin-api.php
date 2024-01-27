<?php
/**
 * Plugin Name:Movies Plugin API
 * Versio:0.0.1
 */

register_activation_hook(__FILE__,'wp_movies_api_table');

Function wp_movies_api_table(){
    global $wpdb;
    $table_name=$wpdb->prefix.'movies';
    $sql='CREATE TABLE $table_name(
        id meduimint(9) NOT NULL AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        image_data IMAGE,
        PRIMARY KEY (id)
    )';

dbDelta($sql);
    
}
add_action('rest_api_init','movies_register_routes');
function movies_register_routes(){
    register_rest_route(
        'movies-form-submission-api-v1',
        '/form-submissions/',
        array(
            'method'=>'GET',
            'callback'=>'movies-get-form-submission',
            'permission_callback'=>'__return_true'
        )
    )
}


function movies-get-form-submission(){
    global $wpdb;
    $table_name=$wpdb->prefix.'form_submission';
    $results=$wpdb->get_results('SELECT * FROM $table_name');
    return $results;
}


?>