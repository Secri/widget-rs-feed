<?php

/* Initialisation des paramètres */
add_action( 'admin_init', 'secritwf_settings_init' );
 
/*Options et paramètres personnalisés*/
function secritwf_settings_init() {
    
	//enregistre une nouvelle zone de paramétrage
    register_setting( 'secritwf_settings', 'secritwf_options' );
 
    
	//enregistre la section des paramètres d'affichage
	add_settings_section(
        'secritwf_param_section0', //ID
        __( '', 'secritwf-plugin' ), //titre
		'secritwf_param_section0_callback', //callback
        'secritwf_settings'
    );
	
	//ajoute un champ pour sélectionner la plateforme sociale
	add_settings_field(
		'secritwf_rs_plateform', //ID
		__( 'Sélectionnez une plateforme', 'secritwf-plugin'), //titre
		'secritwf_rs_plateform_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section0', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_rs_plateform',
            'class'                 => 'secritwf_select',
            'secritwf_custom_data' 	=> 'custom',
        )	
	);	
		
	//ajoute un champ pour sélectionner la taxonomie mère
	add_settings_field(
		'secritwf_main_taxo', //ID
		__( 'Choisissez une taxonomie', 'secritwf-plugin'), //titre
		'secritwf_main_taxo_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section0', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_main_taxo',
            'class'                 => 'secritwf_select',
            'secritwf_custom_data' 	=> 'custom',
        )	
	);	
	//ajoute un champ pour spécifier le terme de la taxonomie qui gèrera l'affichage
	add_settings_field(
		'secritwf_parent_term', //ID
		__( 'Entrez le terme parent', 'secritwf-plugin'), //titre
		'secritwf_parent_term_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section0', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_parent_term',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )	
	);

	//ajoute un champ HTML libre pour personnaliser le titre du widget
	add_settings_field (
		'secrirsf_widget_title', //ID de paramètres
		__( 'Titre du widget', 'secritwf-plugin'), //titre
		'secrirsf_widget_title_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section0', //section où le champ se trouve
		 array(
            'label_for'             => 'secrirsf_widget_title',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )	
	);	
	
	//enregistre une nouvelle section de paramètres
    add_settings_section(
        'secritwf_param_section1', //ID
        __( '', 'secritwf-plugin' ), //titre
		'secritwf_param_section1_callback', //callback
        'secritwf_settings'
    );
	//ajoute un champ pour la gestion du slug Twitter
	add_settings_field(
		'secritwf_twitter_slug', //ID
		__( 'Slug de la page Twitter', 'secritwf-plugin'), //titre
		'secritwf_twitter_slug_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section1', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_twitter_slug',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )
		
	);
	//ajoute un champ pour choisir le nombre de publications à afficher
	add_settings_field(
		'secritwf_twitter_maxpost', //ID
		__( 'Nombre de posts maximum', 'secritwf-plugin'), //titre
		'secritwf_twitter_maxpost_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section1', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_twitter_maxpost',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )	
	);		
		
	//enregistre une nouvelle section de paramètres pour Linkedin
    add_settings_section(
        'secritwf_param_section2', //ID
        __( '', 'secritwf-plugin' ), //titre
		'secritwf_param_section2_callback', //callback
        'secritwf_settings'
    );
	
	//ajoute un champ texte pour la partie HTML
	add_settings_field(
		'secritwf_linkedin_html', //ID
		__( 'Entrez le code HTML du widget', 'secritwf-plugin'), //titre
		'secritwf_linkedin_html_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section2', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_linkedin_html',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )
		
	);
	
	//ajoute un champ texte pour l'appel javascript
	add_settings_field(
		'secritwf_linkedin_js', //ID
		__( 'Entrez le code js du widget', 'secritwf-plugin'), //titre
		'secritwf_linkedin_js_fct', //callback
		'secritwf_settings', //nom de l'option
		'secritwf_param_section2', //section où le champ se trouve
		 array(
            'label_for'             => 'secritwf_linkedin_js',
            'class'                 => 'secritwf_input',
            'secritwf_custom_data' 	=> 'custom',
        )
		
	);
}
 
/* Fonctions de callback appelée par add_settings_section()*/
function secritwf_param_section0_callback( $args ) {
    ?>
		<hr/>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Paramétres d\'affichage', 'secritwf-plugin' ); ?></p>
    <?php
}

function secritwf_param_section1_callback( $args ) {
    ?>
		<hr/>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Paramétrage du widget Twitter.', 'secritwf-plugin' ); ?></p>
    <?php
}

function secritwf_param_section2_callback( $args ) {
    ?>
		<hr/>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Paramétrage du widget Linkedin.', 'secritwf-plugin' ); ?></p>
    <?php
}

/* Fonctions de callback qui gèrent les champs du formulaire */
function secritwf_twitter_slug_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //crée un input de texte
	?>
    <input  type="text" 
			required="required"
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Slug de la page"
			value="<?php echo isset( $options['secritwf_twitter_slug'] ) && $options['secritwf_twitter_slug'] != '' ?  $options['secritwf_twitter_slug'] : ''; ?>">
    </input>
    <p class="description">
		<?php
			if (isset ($options['secritwf_twitter_slug']) && $options['secritwf_twitter_slug'] != '') {
				
				echo __( 'L\'adresse de la page sera https://www.twitter.com/', 'secritwf-plugin') . $options['secritwf_twitter_slug'];
				
			} else {
				
				echo __( 'Entrez le slug de la page Twitter, sous cette forme là : ', 'secritwf-plugin' ); ?> https://www.twitter.com/<b>slug</b> <?php
				
			}
		?>
    </p>
    <?php
}

function secritwf_twitter_maxpost_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //créer un input de texte
	?>
    <input type="number"
		   id="<?php echo esc_attr( $args['label_for'] ); ?>"
		   class="<?php echo esc_attr( $args['class'] ); ?>"
           data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
           name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
		   value="<?php echo isset( $options['secritwf_twitter_maxpost'] ) && $options['secritwf_twitter_maxpost'] != '' ?  $options['secritwf_twitter_maxpost'] : ''; ?>"
		   min='1'>
	</input>
	<p class="description">
		<?php
			if (isset ($options['secritwf_twitter_maxpost']) && $options['secritwf_twitter_maxpost'] != '') {
				
				echo __( 'Nombre de posts affichés: ', 'secritwf-plugin') . $options['secritwf_twitter_maxpost'];
				
			} else {
				
				echo __( 'Entrez le nombre de posts qui s\'afficheront dans le widget.', 'secritwf-plugin' );
				
			}
		?>
	</p>
	<?php
}

function secritwf_main_taxo_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
	$all_taxo = get_taxonomies(array(),'names');
    //créer un select
	?>
    <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
	        required="required"
			class="<?php echo esc_attr( $args['class'] ); ?>"
			data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
			
				<?php
						if (isset ($options['secritwf_main_taxo']) && $options['secritwf_main_taxo'] != '') {
							
							$selected_option = __('Taxonomie sélectionnée','secritwf-plugin');
							
							echo '<optgroup label="' . $selected_option . '">';
							
							echo '<option value=' . $options['secritwf_main_taxo'] . '>' . $options['secritwf_main_taxo'] . '</option>';
							
							echo '</optgroup>';
						
						} else {
							
							echo '<option value="">-- Choisissez une option --</option>';
							
						}
				?>
				<optgroup label="Taxonomies disponibles">
					<?php
						foreach ($all_taxo as $taxo) {
							if($taxo != $options['secritwf_main_taxo']) {
								echo '<option value=' . $taxo . '>'  . $taxo .  '</option>';
							}
						}
					?>
				</optgroup>
	</select>
	<p class="description">
		<?php
			echo __( 'Choisissez la taxonomie du terme parent', 'secritwf-plugin' );
		?>
	</p>
	<?php
}

function secritwf_rs_plateform_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
	$socialNetworks = ['X', 'Linkedin'];
	?>
	<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
	        required="required"
			class="<?php echo esc_attr( $args['class'] ); ?>"
			data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
			
				<?php
						if (isset ($options['secritwf_rs_plateform']) && $options['secritwf_rs_plateform'] != '') {
							
							$selected_option = __('Plateforme sélectionnée','secritwf-plugin');
							
							echo '<optgroup label="' . $selected_option . '">';
							
							echo '<option value=' . $options['secritwf_rs_plateform'] . '>' . $options['secritwf_rs_plateform'] . '</option>';
							
							echo '</optgroup>';
						
						} else {
							
							echo '<option value="">-- Choisissez un réseau social --</option>';
							
						}
				?>
				<optgroup label="Plateforme(s) disponible(s)">
					<?php
						foreach ($socialNetworks as $network) {
							if($network != $options['secritwf_rs_plateform']) {
								echo '<option value=' . $network . '>'  . $network .  '</option>';
							}
						}
					?>
				</optgroup>
	</select>
	<p class="description">
		<?php
					
			if (isset ($options['secritwf_rs_plateform']) && $options['secritwf_rs_plateform'] != '') {
				
				echo __( 'Vous affichez le widget de la plateforme ', 'secritwf-plugin') . $options['secritwf_rs_plateform'];
				
			} else {
				
				echo __( 'Choisissez la plateforme sociale que vous souhaitez utiliser', 'secritwf-plugin' );
				
			}
		
		?>
			
	</p>
	<?php
}

function secritwf_parent_term_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //crée un input de texte
	?>
    <input  type="text" 
			required="required"
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Terme parent"
			value="<?php echo isset( $options['secritwf_parent_term'] ) && $options['secritwf_parent_term'] != '' ?  $options['secritwf_parent_term'] : ''; ?>">
    </input>
    <p class="description">
		<?php
			if (isset ($options['secritwf_parent_term']) && $options['secritwf_parent_term'] != '' ) {
				
				echo __( 'Le widget sera affiché sur les pages présentant les termes: <b>', 'secritwf-plugin') . $options['secritwf_parent_term'] . '</b>/terme';
				
			} else {
				
				echo __( 'Entrez un terme parent pour gérer l\'affichage du widget', 'secritwf-plugin' );
				
			}
		?>
    </p>
    <?php
}

// Champ HTML personnalisé pour le titre du widget
function secrirsf_widget_title_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //crée un input de texte
	?>
    <input  type="text" 
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Code HTML du titre de votre widget"
			style="width:500px"
			value="<?php echo isset( $options['secrirsf_widget_title'] ) && $options['secrirsf_widget_title'] != '' ?  esc_attr( $options['secrirsf_widget_title'] ) : ''; ?>">
    </input>
    <p class="description">
		<?php
		
			echo __( 'Entrez le code HTML du titre qui s\'affichera au dessus de votre widget', 'secritwf-plugin' );
				
		?>
    </p>
    <?php
}

function secritwf_linkedin_html_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //crée un input de texte
	?>
    <input  type="text" 
			required="required"
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Code HTML du widget"
			style="width:500px"
			value="<?php echo isset( $options['secritwf_linkedin_html'] ) && $options['secritwf_linkedin_html'] != '' ?  esc_attr( $options['secritwf_linkedin_html'] ) : ''; ?>">
    </input>
    <p class="description">
		<?php
		
			echo __( 'Entrez le code HTML du widget fourni par votre plateforme social media', 'secritwf-plugin' );
				
		?>
    </p>
    <?php
}

function secritwf_linkedin_js_fct( $args ){
	$options = get_option('secritwf_options', array()); //récupère les options créées
    //crée un input de texte
	?>
    <input  type="text" 
			required="required"
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
			class="<?php echo esc_attr( $args['class'] ); ?>"
            data-custom="<?php echo esc_attr( $args['secritwf_custom_data'] ); ?>"
            name="secritwf_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
			placeholder="Code Javascript du widget"
			style="width:500px"
			value="<?php echo isset( $options['secritwf_linkedin_js'] ) && $options['secritwf_linkedin_js'] != '' ? esc_attr( $options['secritwf_linkedin_js'] ) : ''; ?>">
    </input>
    <p class="description">
		<?php
		
			echo __( 'Entrez le code Javascript d\'appel fourni par votre plateforme social media', 'secritwf-plugin' );
				
		?>
    </p>
    <?php
}

// Hook the 'admin_menu' action hook
add_action( 'admin_menu', 'Add_secritwf_Admin_Link' );
 
// Add a new top level menu link to the ACP
function Add_secritwf_Admin_Link()
{
      add_menu_page(
        __('Paramètres de l\'extension', 'secritwf-plugin'), // Title of the page
        'Social Feed', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'secritwf_settings_page', // Le slug de la page du menu
		'charge_settings_fct',
		'dashicons-networking'
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
        add_settings_error( 'secritwf_settings_msg', 'secritwf_check_settings_content', __( 'Paramètres sauvegardés', 'secritwf-plugin' ), 'updated' ); //affiche un message pour confirmer l'enregistrement des paramètres
    }
    settings_errors( 'secritwf_settings_msg' ); //affiche les messages d'actualisation ou d'erreur
	
    //affiche le contenu de la page 
	?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php 
					settings_fields( 'secritwf_settings' ); //affiche les encards de paramètres créés plus tôt
					do_settings_sections( 'secritwf_settings' ); //affiche les sections de paramètres
					submit_button( 'Enregistrer' ); //affiche un bouton de sauvegarde
				?>
			</form>
		</div>
    <?php
}
