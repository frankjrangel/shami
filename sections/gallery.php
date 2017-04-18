<!-- section gallery -->
<section class="section_gallery" id="section_gallery">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <style>
          .section_gallery .section_title:before { content: "<?php 
                                                              $title = the_field('gallery_title');
                                                              $title = explode(' ', $title);
                                                              $last_word = array_pop($title);
                                                              echo $last_word;
                                                            ?>" }
          @media ( max-width: 768px ) {
            .section_gallery .section_title:before { display: none; }
          }
        </style>
        <h2 class="section_title">&#8722; <?php the_field('gallery_title') ?> &#8722;</h2>
        <hr class="section_title_line">
        <p class="section_caption">
          <?php the_field('gallery_text') ?>
        </p>
      </div>
    </div> <!-- .row -->

    <div class="row gallery__grid">
      <?php // Query gallery posts 
        $the_query = new WP_Query( array(
          'post_type' => 'gallery',
        ) );

        while ( $the_query->have_posts() ) : $the_query->the_post() ?>
          <div class="col-sm-4 gallery__item">
            <a href="<?php the_post_thumbnail_url() ?>" data-lightbox="gallery">
              <img src="<?php the_post_thumbnail_url() ?>" class="img-responsive" alt="<?php the_title() ?>">
            </a>
          </div>
      <?php 
        endwhile; 
        wp_reset_postdata();
      ?>
    </div> <!-- .row -->
  </div> <!-- .container -->
</section>