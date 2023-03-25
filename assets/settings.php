<?php

/* Initialisation des paramètres */
add_action( 'admin_init', 'secriwff_settings_init' );
 
/*Options et paramètres personnalisés*/
function secriwff_settings_init() {
    
	//enregistre un nouveau paramètre
    register_setting( 'secriwff_settings', 'secriwff_options' );
 
    //enregistre une nouvelle section de paramètres
    add_settings_section(
        'secriwff_param_section1', //ID
        __( '', 'secriwff-plugin' ), //titre
		'secriwff_param_section1_callback', //callback
        'secriwff_settings' //slug de la page des paramètres déclarée dans add_menu_page()
    );
 
    //ajoute un nouveau champ pour la gestion du slug facebook
	add_settings_field(
        'secriwff_facebook_slug', //ID
        __( 'Slug de la page facebook', 'secriwff-plugin' ), //titre
        'secriwff_facebook_slug_fct', //callback
        'secriwff_settings', //slug de la page de paramètres
        'secriwff_param_section1', //section où le champ se trouve
        array(
            'label_for'         => 'secriwff_facebook_slug',
            'class'             => 'secriwff_input',
            'secriwff_custom_data' 	=> 'custom',
        )
    );
	
	//ajoute un nouveau champ pour la gestion du contenu à afficher dans le widget
	add_settings_field (
		'secriwff_content_tabs', //ID
		__( 'Gestion des onglets de contenu', 'secriwff-plugin' ), //titre
		'secriwff_content_tabs_fct', //callback
		'secriwff_settings', //slug de la page de paramètres
		'secriwff_param_section1', //section où le champ se trouve
		array(
            'label_for'         => 'secriwff_content_tabs',
            'class'             => 'secriwff_input',
            'secriwff_custom_data' 	=> 'custom',
        )
	);
	
}
 
/* Fonctions de callback appelée par add_settings_section()*/
function secriwff_param_section1_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Gérez l\'affichage du widget facebook.', 'secriwff-plugin' ); ?></p>
    <?php
}
 
/* Fonctions de callback qui gère l'apparence des champs du formulaire */
function secriwff_facebook_slug_fct( $args ){
	$options = get_option('secriwff_options', array()); //récupère les options créées
    //créer un input de texte
	?>
    <input  type="text"  
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secriwff_custom_data'] ); ?>"
            name="secriwff_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Slug"
			value="<?php echo isset( $options['secriwff_facebook_slug'] ) && $options['secriwff_facebook_slug'] != '' ?  $options['secriwff_facebook_slug'] : ''; ?>">
    </input>
    <p class="description">
		<?php
			if (isset ($options['secriwff_facebook_slug']) && $options['secriwff_facebook_slug'] != '') {
				
				echo __( 'L\'adresse de la page sera https://www.facebook.com/', 'secriwff-plugin') . $options['secriwff_facebook_slug'];
				
			} else {
				
				echo __( 'Entrez le slug de la page facebook, sous cette forme là : ', 'secriwff-plugin' ); ?> https://www.facebook.com/<b>slug</b> <?php
				
			}
		?>
    </p>
    <?php
}

function secriwff_content_tabs_fct( $args ){
	$options = get_option('secriwff_options', array()); //récupère les options créées
    //créer un input de texte
	?>
    <input  type="text"  
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secriwff_custom_data'] ); ?>"
            name="secriwff_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Onglets de contenu"
			value="<?php echo isset( $options['secriwff_content_tabs'] ) && $options['secriwff_content_tabs'] != '' ?  $options['secriwff_content_tabs'] : ''; ?>">
    </input>
	<p class="description">
		<?php
			if (isset ($options['secriwff_content_tabs']) && $options['secriwff_content_tabs'] != '') {
				
				$contentOptions = explode(',', $options['secriwff_content_tabs'], 3);
				if ( count($contentOptions) < 2 ) {
					echo __( 'Le Widget affichera uniquement cet onglet : ', 'secriwff-plugin');
				} else { 
					echo __( 'Les onglets affichés dans le widget seront dans l\'ordre : ', 'secriwff-plugin');
				}
							
				for($i = 0; $i < count($contentOptions); $i++){
					
						?>
							<input type ="text"
								   class="<?php echo esc_attr( $args['class'] ); ?>"
								   value="<?php echo $contentOptions[$i] ?>"
								   disabled>
							</input>
							&nbsp;
						<?php
					
				}
				
			} else {
				
				echo __( 'Onglet(s) à afficher dans le widget parmi "timeline", "events" et "messages". Choix multiple possible en séparant par des virgules, sans espace.', 'secriwff-plugin' );

			}
		?>
	</p>
	<?php
}


// Hook the 'admin_menu' action hook
add_action( 'admin_menu', 'Add_secriwff_Admin_Link' );
 
// Add a new top level menu link to the ACP
function Add_secriwff_Admin_Link()
{
      add_menu_page(
        __('Paramètres de l\'extension', 'secriwff-plugin'), // Title of the page
        'Fb widget feed', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'secriwff_settings_page', // Le slug de la page du menu
		'charge_settings_fct'
    );
}

/*Fonction de callback pour afficher tous les éléments dans la page*/
function charge_settings_fct() {
	//vérifie les droits de l'utilisateur
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    //vérifie que l'utilisateur a passé des paramètres
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'secriwff_settings', 'secriwff_check_settings_content', __( 'Paramètres sauvegardés', 'secriwff-plugin' ), 'updated' ); //affiche un message pour confirmer l'enregistrement des paramètres
    }
 
    settings_errors( 'secriwff_check_settings_content' ); //affiche les messages d'actualisation ou d'erreur
    //affiche le contenu de la page ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php 
            settings_fields( 'secriwff_settings' ); //affiche les encards de paramètres créés plus tôt
            do_settings_sections( 'secriwff_settings' ); //affiche les sections de paramètres
            submit_button( 'Enregistrer' ); //affiche un bouton de sauvegarde
            ?>
        </form>
    </div>
    <?php
}
