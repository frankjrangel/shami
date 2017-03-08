<?php

// Hides toolbar in front end
add_filter('show_admin_bar', '__return_false');

// Avoid p tags in the_content()
remove_filter( 'the_content', 'wpautop' );

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
	register_nav_menu('nav-menu',__( 'Menu de navegación' ));
	
	// Required for bootstrap navigation
	require_once('wp_bootstrap_navwalker.php');

	// Bootstrap navigation
	function bootstrap_nav()
	{
		wp_nav_menu( array(
			'theme_location'    => 'nav-menu',
			'depth'             => 2,
			'container'         => 'false',
			'menu_class'        => 'nav navbar-nav navbar-right',
			'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			'walker'            => new wp_bootstrap_navwalker()
		) );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add logo support
	add_theme_support( 'custom-logo', array(
		'height'      => 35,
		'width'       => 140,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	// Add theme support for custom post types thumbnails
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'tipearte_resto_bakery_setup' );


// Register post types
function register_resto_bakery_post_types() {

	// Register menu post type
	$labels = array(
		'name' => 'Menu',
		'singular_name' => 'Plato',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'thumbnail'),
	);
	register_post_type( 'menu', $args );

	// Register reviews post type
	$labels = array(
		'name' => 'Reseñas',
		'singular_name' => 'Reseña',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor','thumbnail'),
	);
	register_post_type( 'review', $args );

	// Register about post type
	$labels = array(
		'name' => 'Nosotros',
		'singular_name' => 'Sección',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'thumbnail'),
	);
	register_post_type( 'about', $args );
	
	// Register team post type
	//$labels = array(
		//'name' => 'Equipo',
		//'singular_name' => 'Miembro',
	//);
	//$args = array(
		//'labels' => $labels,
		//'public' => true,
		//'has_archive' => true,
		//'supports' => array( 'title', 'editor', 'thumbnail'),
	//);
	//register_post_type( 'team', $args );

	// Register gallery post type
	$labels = array(
		'name' => 'Galería',
		'singular_name' => 'Imagen',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'thumbnail'),
	);
	register_post_type( 'gallery', $args );

	// register events post type
	$labels = array(
		'name' => 'Eventos',
		'singular_name' => 'Evento',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor','thumbnail'),
	);
	register_post_type( 'event', $args );

	// register gallery post type
	$labels = array(
		'name' => 'Establecimientos',
		'singular_name' => 'Establecimiento',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'thumbnail'),
	);
	register_post_type( 'place', $args );
}
add_action( 'init', 'register_resto_bakery_post_types' );

function register_resto_bakery_taxonomies() {

	// Regsiter meal type taxonomy
	$labels = array(
		'name'              => 'Tipos de platos',
		'singular_name'     => 'Tipo de plato',
		'search_items'      => 'Buscar tipo de plato',
		'all_items'         => 'Todos los tipos de platos',
		'edit_item'         => 'Editar tipo de plato',
		'update_item'       => 'Actualizar tipo de plato',
		'add_new_item'      => 'Agregar tipo de plato',
		'new_item_name'     => 'Nombre del tipo de plato',
		'menu_name'         => 'Tipos de platos',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tipos-de-platos' ),
	);

	register_taxonomy( 'meal_type', array('menu'), $args);

	// Regsiter about structure taxonomy
	$labels = array(
		'name'              => 'Estructura',
		'singular_name'     => 'Estructura',
		'search_items'      => 'Buscar estructura',
		'all_items'         => 'Todas las estructuras',
		'edit_item'         => 'Editar estructura',
		'update_item'       => 'Actualizar estructura',
		'add_new_item'      => 'Agregar estructura',
		'new_item_name'     => 'Nombre de estructura',
		'menu_name'         => 'Estructura',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'nosotros-estructura' ),
	);

	register_taxonomy( 'about_layout', array('about'), $args);
}
add_action( 'init', 'register_resto_bakery_taxonomies' );

/**
 * Enqueue scripts and styles.
 */
function tipearte_resto_bakery_styles_and_scripts() 
{
	// CSS files
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
    wp_enqueue_script( 'google-maps-library-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGnDWmYKPhKslCvPfkrcZDpgT_QMHT0s&callback=initMap', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'tipearte_resto_bakery_styles_and_scripts' );

// Resgiter custom fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		// Main Page Custom Fields
		'id' => 'acf_main-page',
		'title' => 'Main Page',
		'fields' => array (
			array (
				'key' => 'field_58af14945588f',
				'label' => 'Fondo de bienvenida',
				'name' => 'header_background',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),

			// Section Menu
			array (
				'key' => 'field_58b9d0f1bcf9a',
				'label' => 'Sección Menu',
				'name' => 'menu_section_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58b83e030ee2b',
				'label' => 'Título Menu',
				'name' => 'menu_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58b9d0f1bcf9a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b83e3e0ee2c',
				'label' => 'Texto Menu',
				'name' => 'menu_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58b9d0f1bcf9a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			// Section Review
			array (
				'key' => 'field_58bd7c73836a5',
				'label' => 'Sección Reseñas',
				'name' => 'section_review_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58bd8173d6c65',
				'label' => 'Título reseñas',
				'name' => 'review_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7c73836a5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b6ec09b32bf',
				'label' => 'Fondo reseñas',
				'name' => 'review_background',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7c73836a5',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			
			// Section About
			array (
				'key' => 'field_58bd7db7836a6',
				'label' => 'Sección Nosotros',
				'name' => 'section_about_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58b83e030as63',
				'label' => 'Título Nosotros',
				'name' => 'about_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7db7836a6',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b83e3e0ag76',
				'label' => 'Texto Nosotros',
				'name' => 'about_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7db7836a6',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			// Section Event
			array (
				'key' => 'field_58bd7e1f836a8',
				'label' => 'Sección Eventos',
				'name' => 'section_event_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_50b83e123as63',
				'label' => 'Título Eventos',
				'name' => 'event_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7e1f836a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b54e5a0kj76',
				'label' => 'Texto Eventos',
				'name' => 'event_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58bd7e1f836a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			// Section Join Us
			array (
				'key' => 'field_19bd7a7w821d8',
				'label' => 'Sección Únete',
				'name' => 'section_join_us_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_50c98a213fd63',
				'label' => 'Título Únete',
				'name' => 'join_us_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_19bd7a7w821d8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b53t5a2ly98',
				'label' => 'Texto Únete',
				'name' => 'join_us_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_19bd7a7w821d8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b6fg45678fb',
				'label' => 'Fondo Únete',
				'name' => 'join_us_background',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_19bd7a7w821d8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			// Section Gallery
			array (
				'key' => 'field_58md7o1f765a8',
				'label' => 'Sección Galería',
				'name' => 'section_gallery_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58b73f935ef9f',
				'label' => 'Título Galería',
				'name' => 'gallery_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58md7o1f765a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b740035efa0',
				'label' => 'Texto Galería',
				'name' => 'gallery_text',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58md7o1f765a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

			// Section Map
			array (
				'key' => 'field_58md4r9s865a8',
				'label' => 'Sección Mapa',
				'name' => 'section_map_enabled',
				'type' => 'true_false',
				'message' => 'Activar',
				'default_value' => 0,
			),
			array (
				'key' => 'field_58b09f675df9f',
				'label' => 'Título Mapa',
				'name' => 'map_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58md4r9s865a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),
			array (
				'key' => 'field_58b6ec53928fb',
				'label' => 'Fondo Mapa',
				'name' => 'map_background',
				'type' => 'image',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_58md4r9s865a8',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_menu',
		'title' => 'Menu',
		'fields' => array (
			array (
				'key' => 'field_58b447ccd7e48',
				'label' => 'Precio',
				'name' => 'menu_price',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '$',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 10,
			),
			array (
				'key' => 'field_58b448907b5f5',
				'label' => 'Posición',
				'name' => 'menu_position',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'menu',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_about',
		'title' => 'About',
		'fields' => array (
			array (
				'key' => 'field_58b5887c25bb3',
				'label' => 'Posición',
				'name' => 'about_position',
				'type' => 'number',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'about',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_event',
		'title' => 'Event',
		'fields' => array (
			array (
				'key' => 'field_58bdd1bf68e06',
				'label' => 'Fecha',
				'name' => 'event_date',
				'type' => 'date_picker',
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_58b3212g57cw2',
				'label' => 'Hora',
				'name' => 'event_time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
