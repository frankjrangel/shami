<?php get_header(); ?>

	<?php 
		$timezone_offet = get_option( 'gmt_offset' );
		echo $timezone_offet;
		
		echo current_time( 'timestamp', $gmt = 0 );	
	?>

	<!-- CONTENT - RESTO BAKERY SECTIONS
	 ================================================== -->

	<?php 
		// Load welcome section
		get_template_part('sections/welcome');

		// Load enabled sections

		if ( get_field('menu_section_enabled') )
			get_template_part('sections/menu');

		if ( get_field('section_review_enabled') )
			get_template_part('sections/review');

		if ( get_field('section_about_enabled') )
			get_template_part('sections/about');

		if ( get_field('section_join_us_enabled') )
			get_template_part('sections/join_us');

		if ( get_field('section_gallery_enabled') )
			get_template_part('sections/gallery');

		if ( get_field('section_event_enabled') )
			get_template_part('sections/event');

		if ( get_field('section_map_enabled') )
			get_template_part('sections/map');

		// if ( false )
		// 	get_template_part('sections/team');
	?>

<?php get_footer(); ?>
