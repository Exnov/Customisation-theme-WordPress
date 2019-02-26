<?php



/*
---------------------------------------------------------------------------------------
								AJOUT D'OPTIONS DE PERSONNALISATION DU THEME
---------------------------------------------------------------------------------------
*/

/*
- liens pour les réseaux sociaux et pages mentions légales (cf dernier footer)
- personnalisation de la  mention copyright (cf dernier footer)
*/
function custom_theme_strasbourg( $wp_customize ) {

	//Section liens 
	$wp_customize->add_section('section-liens',array(
			'title'=>'Liens' 
	));

	//Réseaux sociaux
	//lien url facebook
	$wp_customize->add_setting('facebook-link');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-facebook-link',array(
			'label'=>'url facebook',
			'section'=>'section-liens',
			'settings'=>'facebook-link',
			'type'=>'url'
	)));

	//lien url twitter
	$wp_customize->add_setting('twitter-link');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-twitter-link',array(
			'label'=>'url twitter',
			'section'=>'section-liens',
			'settings'=>'twitter-link',
			'type'=>'url'
	)));

	//lien url instagram
	$wp_customize->add_setting('instagram-link');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-instagram-link',array(
			'label'=>'url instagram',
			'section'=>'section-liens',
			'settings'=>'instagram-link',
			'type'=>'url'
	)));	
		
	//Footer
	//lien page Mentions légales
	$wp_customize->add_setting('footer-link1');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-footer-link1',array(
			'label'=>'Footer : lien page mention légales',
			'section'=>'section-liens',
			'settings'=>'footer-link1',
			'type'=>'dropdown-pages'
	)));
	
		//lien page site page
	$wp_customize->add_setting('footer-link2');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-footer-link2',array(
			'label'=>'Footer : lien page sitemap',
			'section'=>'section-liens',
			'settings'=>'footer-link2',
			'type'=>'url'
	)));


	//Section copyright :
	$wp_customize->add_section('section-copyright',array(
			'title'=>'Copyright'
	));

	//copyright
	$wp_customize->add_setting('copyright-mention');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'control-copyright-mention',array(
			'label'=>'mention copyright',
			'section'=>'section-copyright',
			'settings'=>'copyright-mention',
			'type'=>'text'
	)));
	
	//---------------------------------------
}

add_action( 'customize_register', 'custom_theme_strasbourg' );