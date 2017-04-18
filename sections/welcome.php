<!-- section welcome -->
<section class="section_welcome" id="section_welcome">
    <div class="container">
        <div class="row">
			<div class="col-sm-6 col-sm-offset-3">
                <div class="welcome_content">
                    <?php if ( has_post_thumbnail() ): ?>
                        <?php the_post_thumbnail() ?>
                    <?php else: ?>
                        <h1 class="welcome_content_heading"><?php bloginfo('name') ?></h1>
                    <?php endif; ?>
                    <p><?php bloginfo('description') ?></p>
                    <?php while( have_posts() ) : the_post(); ?>
                        <?php the_content() ?> 
                    <?php endwhile; ?>
                </div> <!-- .welcome_content -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->

    <?php 
        $background = get_field('header_background');
        if ( $background ): ?>
            <style>
                .welcome_bg
                {
                    background: url(<?php echo $background ?>);
                    background-size: cover;
                    @media(max-width: 992px)
                    {
                        background: url(<?php echo $background ?>);
                        background-size: cover;
                    }
                }
            </style>
    <?php endif; ?>

	<div class="welcome_bg">
		<?php // Get slider images 
			$the_query = new WP_Query( array(
				'post_type' => 'slider',
			) ); 
		?>

		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div style="background: url('<?php the_post_thumbnail_url(); ?>'); background-size:cover;"></div>
		<?php endwhile; wp_reset_postdata(); ?>	
	</div>
</section>


