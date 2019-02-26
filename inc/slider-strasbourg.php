<?php
/**
 * Slider template
 *
 * @package Sydney
 */

//Slider template
if ( ! function_exists( 'strasbourg_slider_template' ) ) :
function strasbourg_slider_template() {

    if ( (get_theme_mod('front_header_type','slider') == 'slider' && is_front_page()) || (get_theme_mod('site_header_type') == 'slider' && !is_front_page()) ) {

    //Get the slider options
    $text_slide = get_theme_mod('textslider_slide', 0);
    $button     = sydney_slider_button();
    $mobile_slider = get_theme_mod('mobile_slider', 'responsive');

    //Slider text
    if ( !function_exists('pll_register_string') ) {
        $titles = array(
            'slider_title_1' => get_theme_mod('slider_title_1', 'Welcome to Sydney'),
            'slider_title_2' => get_theme_mod('slider_title_2', 'Ready to begin your journey?'),
            'slider_title_3' => get_theme_mod('slider_title_3'),
            'slider_title_4' => get_theme_mod('slider_title_4'),
            'slider_title_5' => get_theme_mod('slider_title_5'),
        );
        $subtitles = array(
            'slider_subtitle_1' => get_theme_mod('slider_subtitle_1', 'Feel free to look around'),
            'slider_subtitle_2' => get_theme_mod('slider_subtitle_2', 'Feel free to look around'),
            'slider_subtitle_3' => get_theme_mod('slider_subtitle_3'),
            'slider_subtitle_4' => get_theme_mod('slider_subtitle_4'),
            'slider_subtitle_5' => get_theme_mod('slider_subtitle_5'),          
        );
    } else {
        $titles = array(
            'slider_title_1' => pll__( get_theme_mod('slider_title_1', 'Click the pencil icon to change this text') ),
            'slider_title_2' => pll__( get_theme_mod('slider_title_2') ),
            'slider_title_3' => pll__( get_theme_mod('slider_title_3') ),
            'slider_title_4' => pll__( get_theme_mod('slider_title_4') ),
            'slider_title_5' => pll__( get_theme_mod('slider_title_5') ),
        );
        $subtitles = array(
            'slider_subtitle_1' => pll__( get_theme_mod('slider_subtitle_1', 'or go to the Customizer') ),
            'slider_subtitle_2' => pll__( get_theme_mod('slider_subtitle_2') ),
            'slider_subtitle_3' => pll__( get_theme_mod('slider_subtitle_3') ),
            'slider_subtitle_4' => pll__( get_theme_mod('slider_subtitle_4') ),
            'slider_subtitle_5' => pll__( get_theme_mod('slider_subtitle_5') ),
        );
    }
    $images = array(
            'slider_image_1' => get_theme_mod('slider_image_1'),
            'slider_image_2' => get_theme_mod('slider_image_2'),
            'slider_image_3' => get_theme_mod('slider_image_3'),
            'slider_image_4' => get_theme_mod('slider_image_4'),
            'slider_image_5' => get_theme_mod('slider_image_5'),
    );


    if ( $images['slider_image_1'] == '' ) {
        return;
    }

    //If the second slide is empty, stop the slider
    if ( $images['slider_image_2'] != '' ) {
        $speed = get_theme_mod('slider_speed', '4000');
    } else {
        $speed = 0;
    }
    ?>

    <div id="slideshow" class="header-slider" data-speed="<?php echo esc_attr($speed); ?>" data-mobileslider="<?php echo esc_attr($mobile_slider); ?>">
        <div class="slides-container">

        <?php 
       //récupération des url des images à la taille souhaitée
        $slides=get_slides($images);
        ?>

        <?php $c = 1; ?>
        <?php foreach ( $slides as $image ) { 
            if ( $image ) { 

                $image_url=esc_url( $image[0] ); 
                $image_alt=esc_attr($image[1]);

                ?>
                <div class="slideA-item slide-item-<?php echo $c; ?>" style="background-image:url('<?php echo ($image_url); ?>');">

                    <img class="mobile-slide preserveA" src="<?php echo ($image_url); ?>" alt="<?php echo ( $image_alt ); ?>"/>

                    <div class="slide-inner">
                        <div class="contain animated fadeInRightBig text-slider">
                        <h2 class="maintitle"><?php echo wp_kses_post( $titles['slider_title_' . $c] ); ?></h2>
                        <p class="subtitle"><?php echo esc_html( $subtitles['slider_subtitle_' . $c] ); ?></p>
                        </div>
                        <?php echo $button; ?>
                    </div>

                </div>

                <?php
            }
            $c++;
        }
        ?>

        </div>  
        <?php if ( $text_slide ) : ?>
            <?php echo sydney_stop_text(); ?>
        <?php endif; ?>
    </div>

    <?php
    }
}
endif;


/*
------------------------------------------------------------------------------
Fonction de récupération des images qui existent au format au 'slider-thumb'
------------------------------------------------------------------------------
*/
function get_slides($images){ //on recupère l'array fourni par la fonction du thème sydney, qui fournit les urls des slides enregistrés
   
    //on recupere les id et url de base de toutes les images   
     $args = array(
          'numberposts' => -1,
          'post_type'   => 'attachment'
        );
         
    $lesimages = get_posts( $args );
    $recup=array(); 
    foreach ($lesimages as $laimage) {
        $donnees=[$laimage->ID,wp_get_attachment_url($laimage->ID)];
        array_push($recup,$donnees);

    }

    //ces images nous permettent de recupérer les images du slider au format souhaité, cad 'slider-thumb'.
    //si l'image n'existe pas au format souhaité, l'image n'est pas affichée
    //récupération des id des images du slider :
    $ids=array();
    foreach ($recup as $items) {
        $id=$items[0];
        $url=$items[1];

        foreach ($images as $image) {
            if($url==$image){
                array_push($ids,$id);
            }
        }
    }

   //récupération des url des images à la taille souhaitée
   $slides=array();

   foreach ($ids as $id) {
       
       //url
        $ref_image=wp_get_attachment_image_src($id, 'slider-thumb'); 

        //alt
        $meta=get_post_meta($id,'_wp_attachment_image_alt');
        $alt_image=$meta[0];

        //si true, on récupère l'url et l'alt de l'image
        if($ref_image[3]==true){
             $compil=[$ref_image[0],$alt_image];
              array_push($slides,$compil);
        }
        //image par défaut pour false ?
   }

   return $slides;
}


