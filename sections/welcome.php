<!-- section welcome -->
<section class="section_welcome" id="section_welcome">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <style>
                    .welcome_content img{ 
                        width: 100%;
                        height: auto; 
                        min-width: 250px;
                        max-width: 450px;
                    }
                    @media (max-width: 768px){
                        .welcome_content img{
                            width: 60%;
                        }
                    }
                </style>
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
    <div class="welcome_bg"></div>
</section>