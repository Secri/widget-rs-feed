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
        __( 'Paramètres', 'secriwff-plugin' ), //titre
		'secriwff_param_section1_callback', //callback
        'secriwff_settings' //slug de la page des paramètres déclarée dans add_menu_page()
    );
 
    //ajoute un nouveau champs de paramètre
	add_settings_field(
        'secriwff_param_test', //ID
        __( 'Paramètre de test', 'secriwff-plugin' ), //titre
        'secriwff_param_test_fct', //callback
        'secriwff_settings', //slug de la page de paramètres
        'secriwff_param_section1', //section où le champ se trouve
        array(
            'label_for'         => 'secriwff_param_test1',
            'class'             => 'secriwff_input',
            'secriwff_custom_data' 	=> 'custom',
        )
    );
	
}
 
/* Fonction de callback appelée par add_settings_section()*/
function secriwff_param_section1_callback( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Section de réglage du widget.', 'secriwff-plugin' ); ?></p>
    <?php
}
 
/* Fonctions qui affichent l'encard de texte pour y entrer son paramètre */
function secriwff_param_test_fct( $args ){
	$options = get_option('secriwff_options', array()); //récupère les options créées
    //créer un input de texte pour y entrer la taxonomie voulue
	?>
    <input  type="text"  
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secriwff_custom_data'] ); ?>"
            name="secriwff_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="category"
			value="<?php echo isset( $options['secriwff_param_test'] ) && $options['secriwff_param_test'] != '' ?  $options['secriwff_param_test'] : 'truc de test'; ?>">
    </input>
    <p class="description">
        <?php esc_html_e( 'Entrez un truc de test', 'secri-plugin' ); ?>
    </p>
    <?php
}


// Hook the 'admin_menu' action hook
add_action( 'admin_menu', 'Add_secriwff_Admin_Link' );
 
// Add a new top level menu link to the ACP
function Add_secriwff_Admin_Link()
{
      add_menu_page(
        'Settings page', // Title of the page
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
