<?php

include plugin_dir_path( __FILE__ ) . './settings.php';

/* Active les taxonomies par défaut sur le post type Page */
function share_taxo_with_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'share_taxo_with_pages' );
