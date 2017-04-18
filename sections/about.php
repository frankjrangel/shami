<!-- section about -->
<section class="section_about" id="section_about">
  <style>
    .section_about .section_title:before { content: "<?php 
                              $title = get_field('about_title');
                              $title = explode(' ', $title);
                              $last_word = array_pop($title);
                              echo $last_word;
                            ?>" }
    @media ( max-width: 768px ) {
      .section_about .section_title:before { display: none; }
    }
  </style>
  <div class="section_row"> 
    <div class="col-sm-12">
      <h2 class="section_title">&#8722; <?php the_field('about_title') ?> &#8722;</h2>
      <hr class="section_title_line">
      <p class="section_caption"><?php the_field('about_text') ?></p>
    </div>
  </div> <!-- .section_row -->

  <?php // Query about rows
    $the_query = new WP_Query( array(
      'post_type' => 'about',
      'meta_key'  => 'about_position',
      'orderby'   => 'meta_value',
      'order'		=> 'ASC',
    ) );
      
    while ( $the_query->have_posts() ) : $the_query->the_post();

      $terms = get_the_terms($post, 'about_layout');
      foreach ( $terms as $term ) : ?>
        <div class="about_table">
          <div class="section_row">
            <?php if ( $term->slug == 'about-right' ) : ?>
              <div class="col-sm-6">
                <div class="about_img" style="background-image: url('<?php the_post_thumbnail_url() ?>')"></div>
              </div>
              <div class="col-sm-6">
                <div class="about_desc">
                  <h3><?php the_title() ?></h3>
                  <?php the_content() ?>
                </div>
              </div>
            <?php else : ?>
              <div class="col-sm-6">
                <div class="about_desc">
                  <h3><?php the_title() ?></h3>
                  <?php the_content() ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="about_img" style="background-image: url('<?php the_post_thumbnail_url() ?>')"></div>
              </div>
            <?php endif; ?>
          </div> <!-- .section_row -->
        </div> <!-- .about_table -->
  <?php
      endforeach;
    endwhile;
    wp_reset_postdata();
  ?>
</section>