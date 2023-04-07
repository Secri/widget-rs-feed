<?php
function secritwf_register_widget() {
	register_widget( 'secritwf_widget' );
}

add_action( 'widgets_init', 'secritwf_register_widget' );

class secritwf_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// widget ID
			'secriwff_widget',
			// widget name
			__('Widget social timeline', 'secritwf-plugin'),
			// widget description
			array( 'description' => __( 'Permet l\'affichage de la timeline Twitter.', 'secritwf-plugin' ), )
			);
	}
	
	/* Gère l'affichage du widget en front */
	public function widget( $args, $instance ) {
				
		echo $args['before_widget'];
		
		//Affiche le titre si il est défini
		if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];		
		
		$options = get_option( 'secritwf_options', array() ); //on récupère les données de la page d'options
		
		//On cherche si la page en front possède une categ (terme de la taxonomie définie en options) en commun avec les paramètres du widget
		
		$display_widget = ''; //Initialisation de la variable d'affichage
		
		if(isset($options['secritwf_main_taxo'])){ // Si une taxonomie a été définie dans les options
			
			$secritwf_parent_term_id = get_term_by('slug', $options['secritwf_parent_term'], $options['secritwf_main_taxo'])->term_id; // On récupère l'id du terme parent défini dans les options
			
			$secritwf_child_terms_id_array = get_term_children( $secritwf_parent_term_id,  $options['secritwf_main_taxo']); // Tableau des id des termes enfants existants
			
			$secritwf_tempo = get_the_terms( get_the_ID(), $options['secritwf_main_taxo'] ); // Tableau d'objets des termes associés à la taxo de la page en front
			
			if(is_array($secritwf_tempo) && is_object($secritwf_tempo[0]) && isset($secritwf_tempo[0]->slug)) { // Si la page en front possède des termes associés à la taxonomie déclarée dans les settings
				
				foreach( $secritwf_tempo as $value) { //On parcourt le tableau d'objets des termes de la page en front
					
					foreach( $secritwf_child_terms_id_array as $term_id ){ // On le compare avec le tableau d'ID des termes
						
						if ( get_term( $term_id )->slug == $value->slug ) { // Si un slug est commun aux deux tableaux
							
							$display_widget = true; // On switch la variable sur true
							
							break; //On arrête la boucle (inutile de continuer)
						}
						
					}

				}
				
			} else {
				
				$categ = 'no term associated to the current post'; // On associe un nom au cas où la page en front n'aurait pas de termes associés
			
			}
		}
		
		unset( $secritwf_parent_term_id );         // On détruit les variables secritwf_temporaires
		unset( $secritwf_child_terms_id_array );
		unset($secritwf_tempo); 
		
		//Si un terme de taxonomie est commun entre la page en front et les enfants du terme parent
		if( $display_widget === true ){
			$this->secritwf_display_the_widget();
		}
		
		echo $args['after_widget'];

	}
	
	private function secritwf_display_the_widget() { // Crée l'ensemble de la pub et l'affiche dans le widget en fonction de l'ID du cpt regie_publicitaire
		
		$options = get_option( 'secritwf_options', array() ); //on récupère les données de la page d'options
		$twitter_href = 'https://twitter.com/' . $options['secritwf_twitter_slug'] . '?ref_src=twsrc%5Etfw';
		echo '&nbsp;';
		echo '<a class="twitter-timeline" href="' . $twitter_href . '" data-width="100%" data-lang="fr" data-chrome="nofooter noheader" data-theme="light" data-tweet-limit="' . $options['secritwf_twitter_maxpost'] . '">';
		echo '@TransfoNum89';
		echo '</a>';
		echo '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
	}

	/*Gestion de l'affichage des options sur le backoffice */
	public function form( $instance ) {
        _e('<br>Ce widget est automatique et ne nécessite pas de paramètres.', 'secritwf-plugin');
	}
	
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
		//Pas de MAJ de l'instance puisque pas de paramètres
	}

}
