<?php
//LOAD JAVASCRIPT
function load_js(){
    wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array('jquery'), null, true );
    wp_enqueue_script('jQuery');
    
    wp_register_script("bootstrap", get_template_directory_uri() . "/js/bootstrap.min.js", array('jquery'), false, true);
    wp_enqueue_script("bootstrap");
    
    wp_register_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', null, null, true );
    wp_enqueue_script('popper');
}
add_action("wp_enqueue_scripts", "load_js");




//LOAD STYLESHEET
function load_css(){
    wp_register_style("bootstrap", get_template_directory_uri() . "/css/bootstrap.min.css", array(), false, "all");
    wp_enqueue_style("bootstrap");
    
    wp_register_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', null, null, true );
    wp_enqueue_style('bootstrap');    

    wp_register_style("main", get_template_directory_uri() . "/css/main.css", array(), false, "all");
    wp_enqueue_style("main");    
    
}
add_action("wp_enqueue_scripts", "load_css");





//THEME OPTIONS
add_theme_support("menus");
add_theme_support("post-thumbnails");
add_theme_support("custom-logo");


////MENUS
//register_nav_menus(
//
//    array(
//        "top-menu" => "Top Menu Location",
//        "mobile-menu" => "Mobile Menu Location",
//    )
//);


//THEME SETUP
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
    
}
add_action( 'after_setup_theme', 'register_navwalker' );

register_nav_menus( array(
    'primary' => __( 'Primary Menu'),
) );





//LOAD ADOBE FONTS
function wpb_add_adobe_fonts() {
   wp_enqueue_style( 'wpb-adobe-fonts', 'https://use.typekit.net/seo3kdh.css', false );
   }
   
   add_action( 'wp_enqueue_scripts', 'wpb_add_adobe_fonts' );




//ADD IMAGE SIZES
add_image_size("grid-item", 377, 367, true);


function themeprefix_vidbg_post_types( $post_types ) {
  /**
   * list the post types you would like Video Background
   * to use in the form of an array
   */
  $post_types = array( 'post', 'page' );
  return $post_types;
}
add_filter( 'vidbg_post_types', 'themeprefix_vidbg_post_types' );
    

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );