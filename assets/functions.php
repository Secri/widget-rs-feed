<?php

	include plugin_dir_path( __FILE__ ) . './settings.php';
	
	/* Active les taxonomies par défaut sur le post type Page */
	function share_taxo_with_pages() {
		register_taxonomy_for_object_type( 'category', 'page' );
	}

	add_action( 'init', 'share_taxo_with_pages' );
	
	/* LOAD PROPER WIDGET RESSOURCES */
	if ( !is_admin() ) { // Si on est en front office
		
		add_action( 'wp_enqueue_scripts', 'wrsf_script_tag' ); //hook de chargement des scripts js des widgets
					
		function wrsf_script_tag() {
			
			$options = get_option( 'secritwf_options', array() ); //on récupère les données de la page d'options
			
			switch ( $options['secritwf_rs_plateform'] ) { // On switch la valeur de la données plateforme
				
				case 'X':
				
					wp_enqueue_script( 'twitter_library', $options['secritwf_twitter_js'], false);
				
				break;
				
				case 'Linkedin':
				
					wp_enqueue_script('elfsight_widget', $options['secritwf_linkedin_js'], false);
					
				break;
			}
		}
		
		// Modification des balises <script> pour ajouter des attributs
		add_filter( 'script_loader_tag', 'wrsf_mod_script_tag', 10, 2);
					
		function wrsf_mod_script_tag( $tag, $handle ) {
			
			if ( $handle == 'elfsight_widget' ) {
				
				return str_replace( '<script', '<script data-use-service-core defer', $tag );
				
			} else if ( $handle == 'twitter_library' ) {
				
				return str_replace( '<script', '<script async charset="utf-8"', $tag );
				
			}
			
			return $tag;
		}
	}
