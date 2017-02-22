<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tipearte_resto_bakery_setup()
{
	// Register theme menu
	register_nav_menu('nav-menu',__( 'Nav Menu' ));
	
	// Required for bootstrap navigation
	require_once('wp_bootstrap_navwalker.php');

	// Bootstrap navigation
	function bootstrap_nav()
	{
		wp_nav_menu( array(
			'theme_location'    => 'header-menu',
			'depth'             => 2,
			'container'         => 'false',
			'menu_class'        => 'nav navbar-nav navbar-right',
			'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			'walker'            => new wp_bootstrap_navwalker()
		) );
	}

	// Add logo theme support
	add_theme_support( 'custom-logo', array(
		'height'      => 35,
		'width'       => 140,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
}
add_action( 'after_setup_theme', 'tipearte_resto_bakery_setup' );

/**
 * Enqueue scripts and styles.
 */
function tipearte_resto_bakery_styles_and_scripts() 
{
	// CSS files
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), '', 'all');
	wp_enqueue_style('bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css', array('bootstrap-css'), '', 'all');
	wp_enqueue_style('lightbox-css', get_template_directory_uri() . '/assets/plugins/lightbox/dist/css/lightbox.css', array(), '', 'all');
	wp_enqueue_style('ionicons-css', get_template_directory_uri() . '/assets/plugins/ionicons/css/ionicons.min.css', array(), '', 'all');
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Javascript files
    wp_enqueue_script( 'jquery-min', get_template_directory_uri() . '/assets/plugins/jquery/jquery-1.12.4.min.js', array(), '', true );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery-min'), '', true );
    wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/assets/plugins/lightbox/dist/js/lightbox.min.js', array(), '', true );
    wp_enqueue_script( 'isotope-js', get_template_directory_uri() . '/assets/plugins/isotope/isotope.pkgd.min.js', array(), '', true );
    wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js', array(), '', true );
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), '', true );
    wp_enqueue_script( 'google-maps-js', get_template_directory_uri() . '/assets/js/google_maps.js', array(), '', true );
}
// TODO agregar google maps
//<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGnDWmYKPhKslCvPfkrcZDpgT_QMHT0s&callback=initMap" async defer></script>
add_action( 'wp_enqueue_scripts', 'tipearte_resto_bakery_styles_and_scripts' );

