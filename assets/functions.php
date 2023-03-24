<?php
/*
 * Ajouter le menu de paramétrage du widget à la page Admin
 */
 
// Hook the 'admin_menu' action hook
add_action( 'admin_menu', 'Add_secriwff_Admin_Link' );
 
// Add a new top level menu link to the ACP
function Add_secriwff_Admin_Link()
{
      add_menu_page(
        'Settings page', // Title of the page
        'Fb widget feed', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'secriwff-admin-page', // The 'slug' - file to display when clicking the link
		'secriwff_admin_menu_page'
    );
}

function secriwff_admin_menu_page () {
	include plugin_dir_path( __FILE__ ) . './settings.php';
}
