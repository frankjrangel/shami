<?php // Query events, show only if present

$the_query = new WP_Query( array(
                'post_type' => 'event',
                'meta_key'	=> 'event_date',
                'orderby'	=> 'meta_value_num',
                'order'		=> 'ASC'
            ) );

if ( $the_query->post_count > 0 ) : ?>

<!-- section events -->
<section class="section_events" id="section_events">
    <div class="container">
        <style>
            .section_about .section_title:before { content: "<?php 
                                                                $title = get_field('event_title');
                                                                $title = explode(' ', $title);
                                                                $last_word = array_pop($title);
                                                                echo $last_word;
                                                            ?>" }
            @media ( max-width: 768px ) {
                .section_about .section_title:before { display: none; }
            }
        </style>
        <div class="row">
            <div class="col-sm-12">
            <h2 class="section_title">&#8722; <?php the_field('event_title') ?> &#8722;</h2>
                <hr class="section_title_line">
                <p class="section_caption"><?php the_field('event_text') ?></p>
            </div> 
        </div> <!-- .row -->

        <div class="row">
            <div class="col-md-12">
                <div class="events">
                    <?php // Loop through events

                        while ( $the_query->have_posts() ) : $the_query->the_post();

                            $identifier = get_the_title();
                            $identifier = explode(' ', $identifier);
                            $identifier = array_pop($identifier);

                            $date = get_field('event_date', false, false);
                            $date = new DateTime($date);
                                        ?>
                            <style>
                                .events__item_<?php echo $identifier; ?> {
                                    background: url('<?php the_post_thumbnail_url() ?>') no-repeat center center / cover;
                                }
                            </style>
                            <div class="events__item events__item_<?php echo $identifier; ?>">
                                <div class="events-item__body">
                                    <div class="events-item__content">
                                        <h2><?php the_title() ?></h2>
                                        <h3 class="events-item__content_extra extra_title"><?php the_title() ?></h3>
                                        <p class="events-item__content_extra extra_caption"><?php the_content() ?></p>
                                        <ul class="events-item__content_extra">
                                            <li><i class="icon ion-ios-calendar-outline"></i> <?php echo date_i18n('d F Y', $date->getTimestamp()); ?></li>
                                            <li><i class="icon ion-ios-clock-outline"></i> <?php the_field('event_time') ?></li>
                                        </ul>
                                            
                                        <!--<div class="events-item__content_extra">
                                            <a href="#section_reservation" class="btn btn-default">Book now</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div> <!-- .events_item -->
                    <?php 
                        endwhile; 
                        wp_reset_postdata();
                    ?>

                </div> <!-- .events -->
            </div> 
        </div> <!-- .row -->

    </div> <!-- .container -->
</section>

<?php endif;