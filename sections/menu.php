<!-- section menu -->
<section class="section_menu" id="section_menu">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <style>
                    .section_menu .section_title:before { content: "<?php 
                                                                        $title = get_field('menu_title');
                                                                        $title = explode(' ', $title);
                                                                        $last_word = array_pop($title);
                                                                        echo $last_word;
                                                                    ?>" }
                    @media ( max-width: 768px ) {
                        .section_menu .section_title:before { display: none; }
                    }
                </style>
                <h2 class="section_title">&#8722; <?php the_field('menu_title') ?> &#8722;</h2>
                <hr class="section_title_line">
                <p class="section_caption">
                    <?php the_field('menu_text') ?>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs menu_nav">
                    <?php // Query menu taxonomies
                        $terms = get_terms( 'meal_type', array(
                            'orderby' => 'description',
                            'exclude' => array( get_term_by( 'name', 'Titulo', 'meal_type' )->term_id ),
                        ) );
                                
                        foreach ($terms as $key => $term) : ?>
                            <li role="presentation" 
                            <?php if ( $key == 0 ) : ?> 
                                class="active"
                            <?php endif ?>
                            ><a href="#" role="tab" data-filter=".menu_<?php echo $term->name ?>"><?php echo $term->name ?></a></li>
                        <?php endforeach ?>
                </ul>
            </div>
        </div>

        <!-- Menu contents -->
        <div class="row menu__grid">
            <?php // Query menu items 
            foreach ( $terms as $term ) :
                $the_query = new WP_Query( array(
                    'post_type' => 'menu',
                    'meta_key'  => 'menu_position',
                    'orderby'   => 'meta_value_num',
                    'order'		=> 'ASC',
                    'tax_query' => array( array(
                        'taxonomy' => 'meal_type',
                        'field' => 'slug',
                        'terms' => $term->slug,
                    ) ),
                ) );

                while ( $the_query->have_posts() ) : $the_query->the_post() ?>
                    <div class="col-sm-4 menu__item menu_<?php echo $term->name ?>" style="cursor:pointer">
                        <div class="menu__item_hover">
                        <img src="<?php the_post_thumbnail_url() ?>" class="img-responsive" alt="<?php the_title() ?>">
                            <div class="menu__item_overlay">
                                <h3 class="menu__item_title"><?php the_title() ?></h3>
                                <p class="overlay_info"><?php the_content() ?></p>
                                <p class="overlay_price">&#36;<?php the_field('menu_price') ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endforeach;
            wp_reset_postdata();
            ?>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>