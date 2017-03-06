<!-- section review -->
<section class="section_review" style="background-image: url('<?php the_field("review_background") ?>')">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2 class="section_review_title"><?php the_field('review_title') ?></h2>
            </div>
            <div class="col-sm-8">
                <div id="carousel-generic" class="carousel slide" data-ride="carousel">
                    <?php // Query about section title
                        $the_query = new WP_Query( array(
                            'post_type' => 'review',
                        ) );
                    ?>	
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php 
                            $number_of_posts = $the_query->post_count;
                            for ( $i = 0; $i < $number_of_posts; $i++ ) : ?>
                                <li data-target="#carousel-generic" data-slide-to="<?php echo $i ?>" 
                                    <?php if ( $i == 0 ) : ?>
                                        class="active"
                                    <?php endif; ?>
                                ></li>
                        <?php endfor; ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post() ?>
                            <div class="item 
                                <?php if ( $the_query->current_post == 0 ) : ?>
                                    active
                                <?php endif ?>
                            ">
                                <p class="review_text"><?php the_content() ?></p>
                                <h5 class="review_author">&#8722; <?php the_title() ?> &#8722;</h5>
                            </div>
                        <?php 
                            endwhile; 
                        wp_reset_postdata();    
                        ?>
                    </div> <!-- .carousel_inner -->
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>