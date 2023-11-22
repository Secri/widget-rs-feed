<?php

include plugin_dir_path( __FILE__ ) . './settings.php';

/* Active les taxonomies par défaut sur le post type Page */
function wrsf_share_taxo_with_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'wrsf_share_taxo_with_pages' );
