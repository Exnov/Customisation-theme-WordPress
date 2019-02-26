<?php


/*
---------------------------------------------------------------------------------------
											CPT
---------------------------------------------------------------------------------------
- 1. pour page "Plus d'infos" ==> 'strasbourg_infos'
- 2. pour page "Activités du mois" ==> 'strasbourg_activites'
- 3. pour page "Accueil" ==> "Boutons menu" ==> 'bouton_menu'
- 4. pour les posts de type "articles" ==> ajout de champs personnalisés (date)
*/	


/*
---------------------------------------------------------------------------------------
						1. pour page "Plus d'infos"
---------------------------------------------------------------------------------------
*/	

/*
---------------------------------
ENREGISTREMENT
---------------------------------
*/
function strasbourg_infos_init() {
	$labels = array(
		'name'               => 'Infos + accueil', 
		'singular_name'      => 'Infos + Accueil',
		'menu_name'          => 'Infos +', 
		'add_new'            => 'Ajouter une info +', 
		'add_new_item'       => 'Ajouter une info + accueil', 
		'edit_item'          => 'Modifier une info + accueil',
		'view_item'          => 'Voir l\'élément',
		'all_items'          => 'Voir la liste',
		'search_items'       => 'Chercher une info + accueil',
		'not_found'          => 'Aucun élément trouvé',
		'not_found_in_trash' => 'Aucune élément dans la corbeille'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'taxonomies' => array('post_tag'),
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ) 
	);

	register_post_type( 'strasbourg_infos', $args ); 
}
add_action( 'init', 'strasbourg_infos_init' );

/*
---------------------------------
COLONNES
---------------------------------
*/

function strasbourg_infos_col_change($columns){
	$columns['strasbourg_infos_order']='Ordre';
	$columns['strasbourg_infos_image']='Event image';
	
	return $columns;
}

add_filter('manage_strasbourg_infos_posts_columns' , 'strasbourg_infos_col_change');

/**/
function strasbourg_infos_content_show( $column, $post_id ) {
	global $post;
	if($column=='strasbourg_infos_order'){
		echo($post->menu_order);
	}
	if($column=='strasbourg_infos_image'){
		echo(the_post_thumbnail(array(100,100))); 
	}
}

add_action( 'manage_posts_custom_column' , 'strasbourg_infos_content_show', 10, 2 );

/**/
function strasbourg_infos_update_ordre_event($query) {
	
	global $post_type, $pagenow;
	
	if($pagenow=='edit.php' && $post_type=='strasbourg_infos'){
		$query->query_vars['orderby']='menu_order';
		$query->query_vars['order']='dsc';
	}
	
}

add_action('pre_get_posts','strasbourg_infos_update_ordre_event'); 
//pour mettre à jour l'affichage dans la liste selon l'ordre après modification de l'ordre dans CPT

/**/
function cake_column_strasbourg_infos( $columns ) {
    $columns['strasbourg_infos_order'] = 'menu_order';
    return $columns;
}

add_filter( 'manage_edit-strasbourg_infos_sortable_columns', 'cake_column_strasbourg_infos' );


/*
---------------------------------------------------------------------------------------
						2. pour page "Activités du mois"
---------------------------------------------------------------------------------------
*/	

/*
---------------------------------
ENREGISTREMENT
---------------------------------
*/
function activites_init() {
	$labels = array(
		'name'               => 'Activités accueil', 
		'singular_name'      => 'Activités Accueil',
		'menu_name'          => 'Activités', 
		'add_new'            => 'Ajouter une activité', 
		'add_new_item'       => 'Ajouter une activité accueil', 
		'edit_item'          => 'Modifier une activité accueil',
		'view_item'          => 'Voir l\'élément',
		'all_items'          => 'Voir la liste',
		'search_items'       => 'Chercher une activité accueil',
		'not_found'          => 'Aucun élément trouvé',
		'not_found_in_trash' => 'Aucune élément dans la corbeille'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'taxonomies' => array('post_tag'),
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ) 
	);

	register_post_type( 'strasbourg_activites', $args ); 
}
add_action( 'init', 'activites_init' );


/*
---------------------------------
META BOX
---------------------------------
*/
//création du champ pour la date :
function strasbourg_activites_meta_construction($post){

	//récupération de l'année enregistrée dans la bdd pour affichage dans meta boxes
	$date_recup=get_post_meta($post->ID,'_activite_meta_date',true);
	
	//sécurité
	wp_nonce_field('strasbourg_activites_secu','XXXXXXXXXXXXXXXXXXX'); 

	echo('<input type="date" name="date_activite" value="'.$date_recup.'"/>');
	
}

function strasbourg_activites_register_meta_box(){
	
	add_meta_box(
		'strasbourg_activites_meta',
		'Date',
		'strasbourg_activites_meta_construction',
		'strasbourg_activites',
		'normal',
		'high'
	);
	
}
add_action('add_meta_boxes','strasbourg_activites_register_meta_box');

//--sauvegarde des données renseignées dans les meta boxes:
function strasbourg_save_meta_box($post_id){
	
	if(get_post_type($post_id)=='strasbourg_activites' && isset($_POST['date_activite'])){
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
			return;
		}
		check_admin_referer('strasbourg_activites_secu','XXXXXXXXXXXXXXXXXXX');		
			
            update_post_meta($post_id,'_activite_meta_date',
				sanitize_text_field($_POST['date_activite']));
	}
	
}

add_action('save_post','strasbourg_save_meta_box');

/*
---------------------------------
COLONNES
---------------------------------
*/

function strasbourg_activites_col_change($columns){
	$columns['strasbourg_activite_order']='Ordre';
	$columns['strasbourg_activite_date']='Date activité';
	
	return $columns;
}
add_filter('manage_strasbourg_activites_posts_columns' , 'strasbourg_activites_col_change');

/**/
function strasbourg_activites_content_show( $column, $post_id ) {
	global $post;
	if($column=='strasbourg_activite_order'){
		echo($post->menu_order);
	}
	if($column=='strasbourg_activite_date'){
		$date_recup=get_post_meta($post->ID,'_activite_meta_date',true);
		echo($date_recup);
	}
}
add_action( 'manage_posts_custom_column' , 'strasbourg_activites_content_show', 10, 2 );

/**/
function strasbourg_activites_update_ordre_event($query) {
	
	global $post_type, $pagenow;
	
	if($pagenow=='edit.php' && $post_type=='strasbourg_activites'){
		$query->query_vars['orderby']='menu_order';
		$query->query_vars['order']='dsc';
	}
	
}
add_action('pre_get_posts','strasbourg_activites_update_ordre_event');

/**/
function cake_column_strasbourg_activites( $columns ) {
    $columns['strasbourg_activite_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-strasbourg_activites_sortable_columns', 'cake_column_strasbourg_activites' );


/*
---------------------------------------------------------------------------------------
						3. pour page "Accueil"
---------------------------------------------------------------------------------------
*/	
/*
---------------------------------
ENREGISTREMENT
---------------------------------
*/
function bouton_menu_init() {
	$labels = array(
		'name'               => 'Boutons menu accueil', 
		'singular_name'      => 'Boutons menu accueil',
		'menu_name'          => 'Boutons menu', 
		'add_new'            => 'Ajouter un bouton', 
		'add_new_item'       => 'Ajouter un bouton accueil', 
		'edit_item'          => 'Modifier une bouton accueil',
		'view_item'          => 'Voir l\'élément',
		'all_items'          => 'Voir la liste',
		'search_items'       => 'Chercher un bouton accueil',
		'not_found'          => 'Aucun élément trouvé',
		'not_found_in_trash' => 'Aucune élément dans la corbeille'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'bouton_menu', $args );
}
add_action( 'init', 'bouton_menu_init' );

/*
---------------------------------
META BOX
---------------------------------
*/
//méta box pour choix de la page du menu à associer au bouton
function strasbourg_btn_menu_meta_construction($post){

	//récupération de l'item menu via son ID
	$id_recup=get_post_meta($post->ID,'_menu_id',true);
	
	//sécurité
	wp_nonce_field('bouton_menu_secu','XXXXXXXXXXXXXXXXXXX'); 

	//affichage du champ :
	//récupération des titres et id des items menus :
	$menu_items=selection_menu_items();
	
	$select='<select name="menu_items">';
	foreach($menu_items as $menu){
		if($menu[1]==$id_recup){
			$select.='<option value="'.$menu[1].'" selected>'.$menu[0].'</option>';
		}
		else{
			$select.='<option value="'.$menu[1].'">'.$menu[0].'</option>';
		}
		
	}
	$select.='</select>';
	echo($select);
	echo('<br/>');
	
}

function strasbourg_btn_menu_register_meta_box(){
	
	add_meta_box(
		'strasbourg_btn_menu_meta',
		'Lien vers page',
		'strasbourg_btn_menu_meta_construction',
		'bouton_menu',
		'normal',
		'high'
	);
	
}
add_action('add_meta_boxes','strasbourg_btn_menu_register_meta_box');

//--sauvegarde des données renseignées dans les meta boxes :
function strasbourg_save_btn_meta_box($post_id){
	
	if(get_post_type($post_id)=='bouton_menu' && isset($_POST['menu_items'])){
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
			return;
		}
		check_admin_referer('bouton_menu_secu','XXXXXXXXXXXXXXXXXXX');		
			
            update_post_meta($post_id,'_menu_id',
				sanitize_text_field($_POST['menu_items']));
	}
	
}
add_action('save_post','strasbourg_save_btn_meta_box');



//récupération des informations items menu 
function get_menu_items($menu_slug) {

  	$menu_items = array();
	$locations = get_nav_menu_locations();

	if (isset($locations[$menu_slug]) && $locations[$menu_slug] != 0 ) {
	    $menu = get_term( $locations[ $menu_slug ] );
	    $menu_items = wp_get_nav_menu_items($menu->term_id);
	 }

  return $menu_items;
}

//récupérations des titres et ID des items menu
function selection_menu_items(){ //retourne un array qui contient des arrays composés de 3 strings (titre et ID et url)

	$menu_items=get_menu_items("primary");
	$menu_selection=array();

	if(isset($menu_items) && sizeof($menu_items)>0){

		foreach ($menu_items as $menu) {

			$menu_temp=[$menu->title,$menu->ID,$menu->url];		
			array_push($menu_selection,$menu_temp);

		}
	}

	return $menu_selection;
}

/*
---------------------------------
COLONNES
---------------------------------
*/
//affiche le titre de colonnes qu'on veut ajouter
function strasbourg_btn_menu_col_change($columns){
	$columns['strasbourg_btn_menu_order']='Ordre';
	$columns['strasbourg_btn_menu_image']='Bouton image';
	
	return $columns;
}
add_filter('manage_bouton_menu_posts_columns' , 'strasbourg_btn_menu_col_change');

//affiche le contenu de nos nouvelles colonnes
function strasbourg_btn_menu_content_show( $column, $post_id ) {
	global $post;

	if($column=='strasbourg_btn_menu_order'){
		echo($post->menu_order);
	}
	if($column=='strasbourg_btn_menu_image'){
		echo(the_post_thumbnail(array(100,100))); 
	}
}
add_action( 'manage_posts_custom_column' , 'strasbourg_btn_menu_content_show', 10, 2 );


/**/
function strasbourg_btn_menu_update_ordre($query) {
	
	global $post_type, $pagenow;
	
	if($pagenow=='edit.php' && $post_type=='bouton_menu'){
		$query->query_vars['orderby']='menu_order';
		$query->query_vars['order']='asc';
	}
	
}
add_action('pre_get_posts','strasbourg_btn_menu_update_ordre');


/**/
function cake_column_bouton_menu( $columns ) {
    $columns['strasbourg_btn_menu_order'] = 'menu_order';
    return $columns;
}

add_filter( 'manage_edit-bouton_menu_sortable_columns', 'cake_column_bouton_menu' );


/*
---------------------------------------------------------------------------------------
						4. pour les posts de type "articles"
---------------------------------------------------------------------------------------
*/	
/*
---------------------------------
META BOX
---------------------------------
*/
//création champs date pour les articles :
function strasbourg_actus_meta_construction($post){

	//récupération de la date enregistrée dans la bdd pour affichage dans meta boxes
	$date_recup=get_post_meta($post->ID,'_actus_meta_date',true);
	$date_recup2=get_post_meta($post->ID,'_actus_meta_date2',true);

	//sécurité
	wp_nonce_field('strasbourg_actus_secu','XXXXXXXXXXXXXXXXXXX');

	echo('<p>du ');
	echo('<input type="date" name="date_actus" value="'.$date_recup.'"/>');
	echo(' au ');
	echo('<input type="date" name="date_actus2" value="'.$date_recup2.'"/>');
	echo('</p>');
	echo('<p>*si aucune date n\'est saisie, la date de publication sera la date de l\'événement</p>');
	echo('<p>*si événement sur 1 seul jour, ne rien préciser pour la seconde date</p>');
	
}

function strasbourg_actus_register_meta_box(){	
	add_meta_box(
		'strasbourg_actus_meta',
		'Date(s) événement',
		'strasbourg_actus_meta_construction',
		'post',
		'normal',
		'high'
	);
	
}
add_action('add_meta_boxes','strasbourg_actus_register_meta_box');

//--sauvegarde des données renseignées dans les meta boxes :
function strasbourg_save_actus_meta_box($post_id){
	
	if(get_post_type($post_id)=='post' && isset($_POST['date_actus'])){
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
			return;
		}
		check_admin_referer('strasbourg_actus_secu','XXXXXXXXXXXXXXXXXXX');		
			
            update_post_meta($post_id,'_actus_meta_date',
				sanitize_text_field($_POST['date_actus']));
            update_post_meta($post_id,'_actus_meta_date2',
				sanitize_text_field($_POST['date_actus2']));            
	}
	
}

add_action('save_post','strasbourg_save_actus_meta_box');


/*
---------------------------------
COLONNES
---------------------------------
*/
function strasbourg_actus_col_change($columns){
	$columns['strasbourg_actu_date']='Date(s) event';
	return $columns;
}

add_filter('manage_post_posts_columns' , 'strasbourg_actus_col_change');

/**/
function strasbourg_actus_content_show( $column, $post_id ) {
	global $post;
	if($column=='strasbourg_actu_date'){
		$date=get_display_date_event($post->ID);
		echo($date);
	}
}

add_action( 'manage_post_posts_custom_column' , 'strasbourg_actus_content_show', 10, 2 );


/*
---------------------------------
FONCTIONS
---------------------------------
*/
/*
- fontions appelées dans post de type 'post' et aussi ailleurs 
- recupéreration des dates des actualités pour affichage dans article (cf content-actu.php et content-accueil.php et affichage colonne articles dans dashboard)
*/
function get_date_event($post_id, $slug){
			$date_recup=get_post_meta($post_id,$slug,true);
			$date = new DateTime($date_recup);
			$date_event=$date->format('d/m/Y');
			return $date_event;
}

function get_display_date_event($post_id){
			$date=get_date_event($post_id,'_actus_meta_date');
			$date2=get_date_event($post_id,'_actus_meta_date2');
			$date_event=$date;
			if($date!=$date2):
				$date_event=$date.' au '.$date2;
			endif;

			return $date_event;
}

//pour attribut datetime de balise datetime, seulement la date1
function format_datetime($post_id){
			$date_recup=get_post_meta($post_id,'_actus_meta_date',true);
			$date = new DateTime($date_recup);
			$date_event=$date->format('Y-m-d');
			return $date_event;
}