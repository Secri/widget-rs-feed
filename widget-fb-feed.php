<?php
/*
Plugin Name: Widget Facebook Feed
Plugin URI: 
Description: Plugin permettant de générer un widget feed facebook
Authors: Christophe IENZER
Version: 0.1
Author URI: https://www.linkedin.com/in/christophe-ienzer/
*/

require_once plugin_dir_path(__FILE__) . 'assets/function.php'; //gestion des metabox
require_once plugin_dir_path(__FILE__) . 'assets/columns.php'; //gestion de l'affichage des colonnes dans "toutes les publicités"
require_once plugin_dir_path(__FILE__) . 'assets/widget.php'; //création du widget associé au plugin 

/* Ajout de scripts et de CSS au plugin */
add_action( 'admin_enqueue_scripts', 'SECRIWFF_enqueue', 11 );

function SECRIWFF_enqueue() {

    global $post_type;
    if ( $post_type == 'regie_publicitaire' ){ //teste si l'on se situe dans le bon post-type
		wp_register_style( 'style', plugins_url( '/assets/css/style.css', __FILE__) ); //enregistrement du style css
		wp_enqueue_style('style'); //ajout du style css
	}
}

/*Permet de tester s'il n'y a pas d'erreur à l'activation du plugin*/
function SECRIWFF_activate() {
	
   if ($error) {
      die($error); //si une erreur est rencontrée, on annule l'activation
   }
}

register_activation_hook(__DIR__, '/secriwff.php', 'SECRIWFF_activate' );

/*Ajoute un lien vers la page de réglages sous le nom du plugin dans la page d'extensions*/
function SECRIWFF_add_settings_link( $links ) {
    $settings_link = '<a href="edit.php?post_type=regie_publicitaire&page=ad_settings">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'SECRIWFF_add_settings_link' );
