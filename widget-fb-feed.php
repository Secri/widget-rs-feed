<?php
/*
Plugin Name: Widget Facebook Feed
Plugin URI: 
Description: Plugin permettant de générer un widget feed facebook
Authors: Christophe IENZER
Version: 0.1
Author URI: https://www.linkedin.com/in/christophe-ienzer/
*/

/* Chargement des ressources PHP pour gérer le plugin */
require_once plugin_dir_path(__FILE__) . 'assets/functions.php'; //gestion des metabox
require_once plugin_dir_path(__FILE__) . 'assets/widget.php'; //création du widget associé au plugin 

/* Ajout de scripts et de CSS au plugin */
add_action( 'admin_enqueue_scripts', 'SECRIWFF_enqueue', 11 );


/*Permet de tester s'il n'y a pas d'erreur à l'activation du plugin*/
function SECRIWFF_activate() {
	
   if ($error) {
      die($error); //si une erreur est rencontrée, on annule l'activation
   }
}

register_activation_hook(__DIR__, '/secriwff.php', 'SECRIWFF_activate' );
