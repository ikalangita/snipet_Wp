<?php

	/*
	============================================
		WORDPRESS // COLONNES SECTEURS
	============================================
	*/
	add_filter('manage_edit-offre_emploi_columns', 'offre_emploi_column_register');
	add_filter('manage_edit-offre_emploi_sortable_columns', 'offre_emploi_column_register');
	add_action('manage_offre_emploi_posts_custom_column', 'offre_emploi_column_display', 10, 2);

	function offre_emploi_column_register( $columns, $var = null ) {

		$columns['secteur'] = __( 'secteur', 'kblt' );
    	$columns['contrat'] = __( 'contrat', 'kblt' );
    	$columns['lieu'] 	= __( 'lieu', 'kblt' );
    	
	    return $columns;
	}
	
	
	function offre_emploi_column_display( $column_name, $post ) {
		global $post;
		global $wpdb;

		# Afficher la colonne secteur
		if ( 'secteur' == $column_name ){

	        $secteur 	= get_post_meta($post->ID, 'field_id', true);
	       	$exp 	 	= explode("_", $secteur);
	       	$id_secteur = $exp[1];

	       	$q = $wpdb->get_results( "
	       		SELECT sect.libel_secteur 
	       		FROM 45tr4zzb_secteur As sect
				WHERE sect.id_secteur =".$id_secteur, ARRAY_A  );

	       	foreach ($q as $s) {
	       		# code...
	       		echo $s["libel_secteur"];
	       	}
	    }

	    if ( 'contrat' == $column_name ){

	        $contrat = get_post_meta($post->ID, 'contrat', true);
	        echo $contrat;
	    }

	    if ( 'lieu' == $column_name ){

	        $lieu = get_post_meta($post->ID, 'lieu', true);
	        echo $lieu;
	    }

	    
	}

	function sort_columns( $vars ) {
		if( array_key_exists('orderby', $vars )) {
			# Trier par contrat 
			if('contrat' == $vars['orderby']) {
				$vars['orderby'] = 'meta_value';
				$vars['meta_key'] = 'contrat';
			}
			# Trier par lieu 
			if('lieu' == $vars['orderby']) {
				$vars['orderby'] = 'meta_value';
				$vars['meta_key'] = 'lieu';
			}
			# Trier par secteur 
			if('secteur' == $vars['orderby']) {
				$vars['orderby'] = 'meta_value';
				$vars['meta_key'] = 'field_id';
			}
		}
		return $vars;
	}
	add_filter('request', 'sort_columns');