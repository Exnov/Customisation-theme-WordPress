<?php


/*
---------------------------------------------------------------------
CHARGEMENT DES SCRIPTS
---------------------------------------------------------------------
*/
function theme_enqueue_styles_scripts() {

	//feuilles de style :
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('bootstrap',site_url().'/wp-content/themes/strasbourg/css/bootstrap.min.css');
	wp_enqueue_style( 'fontawesome','https://use.fontawesome.com/releases/v5.3.1/css/all.css');
	wp_enqueue_style( 'child-css',get_stylesheet_uri(),array('parent-style','fontawesome','bootstrap')); 

	//scripts :
	wp_enqueue_script('bootstrap-js',site_url().'/wp-content/themes/strasbourg/js/bootstrap.min.js',array(),'',true);
	$pagename = get_query_var('pagename');  
	if($pagename=="activites-du-mois"){
		wp_enqueue_script('child-js',site_url().'/wp-content/themes/strasbourg/js/js.js',array('bootstrap-js'),'',true);
	}
	
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles_scripts');


/*
---------------------------------------------------------------------
WIDGET
---------------------------------------------------------------------
*/


//permet d'ajouter un extrait (avec photo) aux articles affichés en sidebar
function register_recent_post_custom_widget() {
	include('inc/widgets/build-recent-post-excerpt-widget.php');
    register_widget( 'WP_Widget_Recent_Posts_Custom' );
}
add_action( 'widgets_init', 'register_recent_post_custom_widget' );


/*
---------------------------------------------------------------------
PERSONNALISATION 
---------------------------------------------------------------------
*/


//Ajout d'une barre de recherche dans le menu
function add_search_form($items, $args) {
          if( $args->theme_location == 'primary' ){

	          $items .= '<li class="menu-item" id="strasbourg-search">'
	                  . '<form role="search" method="get" class="search-form" action="'.home_url( '/' ).'">'	                  
	                  . '<input type="search" placeholder="Recherche..." name="s" size="8" title="recherche"/>'
	                  . '<button type="submit"><i class="fa fa-search"></i></button>'
	                  . '</form>'
	                  . '</li>';
	        }
	       
        return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

//Ajout de formats d'images
function images_strasbourg_setup() {
    add_image_size( 'infos-thumb', 300, 180, true ); // (cropped) page 'Plus d'infos' (content-info.php)
    add_image_size( 'boutons-thumb', 500, 300, true ); // (cropped) page 'Accueil' (content-accueil.php)
    add_image_size( 'slider-thumb', 1500, 900, true ); // (cropped) slider (/inc/slider-strasbourg.php)
}
add_action( 'after_setup_theme', 'images_strasbourg_setup' );



/*
---------------------------------------------------------------------
FONCTIONS
---------------------------------------------------------------------
*/


//------------------- Pour pages Actualités, et Accueil
//affichage des dates, et de la catégorie :
function affichage_meta($date1,$date2,$cat,$auteur){ 
	
	$chaine=$cat.' - publié le <time class="entry-date" datetime="'.$date1.'">'.$date2.'</time> - '.$auteur;
	
	return $chaine;
}

//------------------- Pour page accueil
//récupération du dernier article
function get_last_post(){
	
	$args=array(
		'numberposts' => 1,
		'post_type'=>'post',
		'orderby' => 'date' 
	);

	$latest_post = get_posts( $args );

	return $latest_post[0];
}

//------------------- Pour les <img> des CPT
//récupération de la valeur de l'alt de l'image				
function get_image_alt($post_id){
	
	$id_image=get_post_thumbnail_id($post_id);
	$meta=get_post_meta($id_image,'_wp_attachment_image_alt');
	$alt=$meta[0];
	
	return $alt;	
}




/*
---------------------------------------------------------------------
IMPORT PHP
---------------------------------------------------------------------
*/


/*
-----------------------------------------------------------------
CPT
-----------------------------------------------------------------
*/
require("inc/cpt-strasbourg.php");


/*
-----------------------------------------------------------------
Customisation du slider; remplacement de la fonction sydney_slider_template() par strasbourg_slider_template() dans header.php
-----------------------------------------------------------------
*/
require("inc/slider-strasbourg.php");


/*
-----------------------------------------------------------------
Ajout d'options de personnalisation : liens et copyright
-----------------------------------------------------------------
*/
require("inc/customize-strasbourg.php");











