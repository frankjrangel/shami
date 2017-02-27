<?php get_header(); ?>

	<!-- CONTENT
	 ================================================== -->

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
		<div class="welcome_bg"></div>
	</section>

    <!-- section menu -->
    <section class="section_menu" id="section_menu">
		<div class="container">

			<div class="row">
				<div class="col-sm-12">
					<h2 class="section_title">&#8722; Menu &#8722;</h2>
					<hr class="section_title_line">
					<?php // Query menu section title
						$the_query = new WP_Query( array(
							'post_type' => 'menu',
							'tax_query' => array( array(
								'taxonomy' => 'meal_type',
								'field' => 'slug',
								'terms' => 'menu-titulo',
							) ),
						) );

						while ( $the_query->have_posts() ) : $the_query->the_post() ?>
							<p class="section_caption">
								<?php the_content() ?>
							</p>
					<?php
						endwhile;
						wp_reset_postdata();
					?>
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
							<!-- TODO delete, por ahora para referencia <li role="presentation"><a href="#" role="tab" data-filter=".menu_desserts">Desserts</a></li> -->
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
						'orderby'   => 'meta_value',
						'order'		=> 'ASC',
						'tax_query' => array( array(
							'taxonomy' => 'meal_type',
							'field' => 'slug',
							'terms' => $term->slug,
						) ),
					) );

					while ( $the_query->have_posts() ) : $the_query->the_post() ?>
						<div class="col-sm-4 menu__item menu_<?php echo $term->name ?>">
							<div class="menu__item_hover">
							<img src="<?php the_post_thumbnail_url() ?>" class="img-responsive" alt="<?php the_title() ?>">
								<div class="menu__item_overlay">
									<h3 style="font-family: 'Josefin Sans"><?php the_title() ?></h3>
									<p class="overlay_info"><?php the_content() ?></p>
									<p class="overlay_price">&#36;<?php the_field('menu_price') ?></p>
								</div>
							</div>
						</div>
				<?php
					endwhile;
					wp_reset_postdata();
				endforeach;
				?>
        	</div> <!-- .row -->
        </div> <!-- .container -->
    </section>

    <!-- section about -->
	<section class="section_about" id="section_about">
		
		<?php // Query history section title
			$the_query = new WP_Query( array(
				'post_type' => 'about',
				'tax_query' => array( array( 
					'taxonomy' => 'about_structure',
					'field' => 'slug',
					'terms' => 'about-title'
				) ),
			) );
				
			while ( $the_query->have_posts() ) : $the_query->the_post() ?>
				<style>
					.section_about .section_title:before { content: "<?php 
																		$title = get_the_title();
																		$title = explode(' ', $title);
																		$last_word = array_pop($title);
																		echo $last_word;
																	?>" }
				</style>
				<div class="section_row"> 
					<div class="col-sm-12">
						<h2 class="section_title">&#8722; <?php the_title() ?> &#8722;</h2>
						<hr class="section_title_line">
						<p class="section_caption"><?php the_content() ?></p>
					</div>
				</div> <!-- .section_row -->
		<?php 
			endwhile;
			wp_reset_postdata();
		?>


        <div class="about_table">
          <div class="section_row">
            <div class="col-sm-6">
              <div class="about_img_1"></div>
            </div>
            <div class="col-sm-6">
              <div class="about_desc">
                <h3>* Traditions</h3>
                <p>Service ipsum dolor sit amet, consectetur adipisicing elit. Nulla dolore voluptatem, ipsum, totam molestias accusantium explicabo velit aliquid impedit, reprehenderit libero voluptatum ipsa quae ad! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum atque debitis commodi architecto. Nulla dolore voluptatem. Eum atque debitis commodi architecto. Totam molestias accusantium explicabo velit aliquid impedit.</p>
              </div>
            </div>
          </div> <!-- .section_row -->
        </div> <!-- .about_table -->
        <div class="about_table">
          <div class="section_row">
            <div class="col-sm-6">
              <div class="about_desc">
                <h3>* Professional service</h3>
                <p>Roles ipsum dolor sit amet, consectetur adipisicing elit. Nulla dolore voluptatem, ipsum, totam molestias accusantium explicabo velit aliquid impedit, reprehenderit libero voluptatum ipsa quae ad! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum atque debitis commodi architecto. Groggery ipsum dolor sit amet, consectetur adipisicing elit. Soluta modi esse accusantium sit velit cupiditate minima ipsam ex!</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="about_img_2"></div>
            </div>
          </div> <!-- .section_row -->
        </div>
        <div class="about_table">
          <div class="section_row">
            <div class="col-sm-6">
              <div class="about_img_3"></div>
            </div>
            <div class="col-sm-6">
              <div class="about_desc">
                <h3>* Our principles</h3>
                  <p>&#9734; Fresh products<br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque suscipit officiis iure iste, alias voluptatibus.</p>
                  <p>&#9734; Healthy food<br>Saepe inventore deleniti nam, id ducimus eveniet facilis, distinctio illo architecto atque.</p>
                  <p>&#9734; Traditional methods<br>Ipsa voluptate nemo reiciendis cum, rem perferendis qui quis quibusdam quisquam.</p>
              </div>
            </div>
          </div> <!-- .section_row -->
        </div> <!-- .about_table -->
      </section>

      <!-- section team -->
      <section class="section_team">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2 class="section_title">&#8722; Our team &#8722;</h2>
              <hr class="section_title_line">
              <p class="section_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias, facere.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="team__item">
                <div class="team__item_photo">
                  <img class="img-responsive" src="http://placehold.it/729x768" alt="...">
                </div>
                <div class="team__item_name">
                  <h3>John Doe</h3>
                </div>
                <div class="team__item_overlay">
                  <p class="team__item_profession">Master chef</p>
                  <ul class="team__item_social">
                    <li class="social_icon"><a href="#"><i class="icon ion-social-facebook-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-twitter-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-instagram-outline"></i></a></li>
                  </ul>
                </div>
              </div> <!-- .team_item -->
            </div>
            <div class="col-sm-4">
              <div class="team__item">
                <div class="team__item_photo">
                  <img class="img-responsive" src="http://placehold.it/729x768" alt="...">
                </div>
                <div class="team__item_name">
                  <h3>Jane Doe</h3>
                </div>
                <div class="team__item_overlay">
                  <p class="team__item_profession">Chef</p>
                  <ul class="team__item_social">
                    <li class="social_icon"><a href="#"><i class="icon ion-social-facebook-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-twitter-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-instagram-outline"></i></a></li>
                  </ul>
                </div>
              </div> <!-- .team_item -->
            </div>
            <div class="col-sm-4">
              <div class="team__item">
                <div class="team__item_photo">
                  <img class="img-responsive" src="http://placehold.it/729x768" alt="...">
                </div>
                <div class="team__item_name">
                  <h3>John Doe</h3>
                </div>
                <div class="team__item_overlay">
                  <p class="team__item_profession">Barman</p>
                  <ul class="team__item_social">
                    <li class="social_icon"><a href="#"><i class="icon ion-social-facebook-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-twitter-outline"></i></a></li>
                    <li class="social_icon"><a href="#"><i class="icon ion-social-instagram-outline"></i></a></li>
                  </ul>
                </div>
              </div> <!-- .team_item -->
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section slogan -->
      <section class="section_slogan">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="slogan_title">&#8722; Groggery &#8722;</h1>
              <p class="slogan_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, cumque, quia. Laboriosam eveniet suscipit obcaecati corrupti quam.</p>
            </div>
          </div> <!--row . -->
        </div> <!-- .container -->
      </section>

      <!-- section gallery -->
      <section class="section_gallery" id="section_gallery">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2 class="section_title">&#8722; Gallery &#8722;</h2>
              <hr class="section_title_line">
              <p class="section_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam iure, quos maxime amet nostrum reiciendis, provident quisquam nulla!</p>
            </div>
          </div> <!-- .row -->
          <div class="row gallery__grid">
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/684x1024" data-lightbox="gallery">
                <img src="http://placehold.it/684x1024" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x647" data-lightbox="gallery">
                <img src="http://placehold.it/1024x647" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/759x1024" data-lightbox="gallery">
                <img src="http://placehold.it/759x1024" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
            <div class="col-sm-4 gallery__item">
              <a href="http://placehold.it/1024x682" data-lightbox="gallery">
                <img src="http://placehold.it/1024x682" class="img-responsive" alt="...">
              </a>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section review -->
      <section class="section_review">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <h2 class="section_review_title">A few words about us...</h2>
            </div>
            <div class="col-sm-8">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <p class="review_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, modi vel quidem maiores veniam debitis animi in quasi, libero hic nemo mollitia nam. Quos cumque et, similique ipsum voluptatum hic optio ullam doloribus. Sed, corporis!</p>
                    <h5 class="review_author">&#8722; Franz Kafka &#8722;</h5>
                  </div>
                  <div class="item">
                    <p class="review_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, modi vel quidem maiores veniam debitis animi in quasi, libero hic nemo mollitia nam. Quos cumque et, similique ipsum voluptatum hic optio ullam doloribus. Sed, corporis!</p>
                    <h5 class="review_author">&#8722; Ernest Hemingway &#8722;</h5>
                  </div>
                  <div class="item">
                    <p class="review_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, modi vel quidem maiores veniam debitis animi in quasi, libero hic nemo mollitia nam. Quos cumque et, similique ipsum voluptatum hic optio ullam doloribus. Sed, corporis!</p>
                    <h5 class="review_author">&#8722; Pablo Picasso &#8722;</h5>
                  </div>
                </div> <!-- .carousel_inner -->
              </div>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section events -->
      <section class="section_events" id="section_events">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2 class="section_title">&#8722; Events &#8722;</h2>
              <hr class="section_title_line">
              <p class="section_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, assumenda vitae earum voluptatibus.</p>
            </div>
          </div> <!-- .row -->
          <div class="row">
            <div class="col-md-12">
              <div class="events">
                <div class="events__item events__item_jazz">
                  <div class="events-item__body">
                    <div class="events-item__content">
                      <h2>Jazz</h2>
                      <h3 class="events-item__content_extra extra_title">Jazz Jam session</h3>
                      <p class="events-item__content_extra extra_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem molestias minus, fuga dolor.</p>
                      <ul class="events-item__content_extra">
                        <li><i class="icon ion-ios-calendar-outline"></i> September 28, 2016</li>
                        <li><i class="icon ion-ios-clock-outline"></i> 19:30</li>
                      </ul>
                      <div class="events-item__content_extra">
                        <a href="#section_reservation" class="btn btn-default">Book now</a>
                      </div>
                    </div>
                  </div>
                </div> <!-- .events_item -->
                <div class="events__item events__item_music">
                  <div class="events-item__body">
                    <div class="events-item__content">
                      <h2>Live music</h2>
                      <h3 class="events-item__content_extra extra_title">Live concert with our friends</h3>
                      <p class="events-item__content_extra extra_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur sint similique beatae eius, reprehenderit corporis.</p>
                      <ul class="events-item__content_extra">
                        <li><i class="icon ion-ios-calendar-outline"></i> October 5, 2016</li>
                        <li><i class="icon ion-ios-clock-outline"></i> 19:00</li>
                      </ul>
                      <div class="events-item__content_extra">
                        <a href="#section_reservation" class="btn btn-default">Book now</a>
                      </div>
                    </div>
                  </div>
                </div> <!-- .events_item -->
                <div class="events__item events__item_poetry">
                  <div class="events-item__body">
                    <div class="events-item__content">
                      <h2>Poetry evening</h2>
                      <h3 class="events-item__content_extra extra_title">Modern poetry</h3>
                      <p class="events-item__content_extra extra_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione vero commodi enim, ullam ex sit mollitia, saepe assumenda.</p>
                      <ul class="events-item__content_extra">
                        <li><i class="icon ion-ios-calendar-outline"></i> October 9, 2016</li>
                        <li><i class="icon ion-ios-clock-outline"></i> 20:00</li>
                      </ul>
                      <div class="events-item__content_extra">
                        <a href="#section_reservation" class="btn btn-default">Book now</a>
                      </div>
                    </div>
                  </div>
                </div> <!-- .events_item -->
                <div class="events__item events__item_wine">
                  <div class="events-item__body">
                    <div class="events-item__content">
                      <h2>Wine degustation</h2>
                      <h3 class="events-item__content_extra extra_title">Large selection of delicious wine</h3>
                      <p class="events-item__content_extra extra_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique eius minima, dolorum eveniet amet aperiam eaque esse animi.</p>
                      <ul class="events-item__content_extra">
                        <li><i class="icon ion-ios-calendar-outline"></i> October 17, 2016</li>
                        <li><i class="icon ion-ios-clock-outline"></i> 19:30</li>
                      </ul>
                      <div class="events-item__content_extra">
                        <a href="#section_reservation" class="btn btn-default">Book now</a>
                      </div>
                    </div>
                  </div>
                </div> <!-- .events_item -->
              </div> <!-- .events -->
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section newsletter -->
      <section class="section_newsletter">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <p class="section_newsletter_title-sm">Subscribe for our</p>
              <h2 class="section_newsletter_title-lg">Newsletter</h2>
            </div>
            <div class="col-sm-8">
              <!-- Newsletter form -->
              <form class="newsletter__form">
                <div class="form-group col-sm-9">
                  <label for="newsletter__email" class="sr-only">E-mail address</label>
                  <input type="email" class="form-control newsletter_input" id="newsletter__email" placeholder="E-mail address">
                </div>
                <a href="#" class="btn btn-default">Subscribe</a>
              </form>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section reservation -->
      <section class="section_reservation" id="section_reservation">
        <div class="section_row">
          <div class="col-md-5">
            <div class="reservation_img"></div>
          </div>
          <div class="col-md-7">
            <div class="reservation_form_body">
              <h3 class="reservation_form_title">Online reservation</h3>
              <hr class="section_title_line">
              <p class="section_caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <form class="reservation_form">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="sr-only" for="reservation__name">Full Name</label>
                      <input type="text" class="form-control" id="reservation__name" name="username" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="reservation__phone">Phone Number</label>
                      <input type="tel" class="form-control" id="reservation__phone" name="phone" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="reservation__phone">Your e-mail</label>
                      <input type="email" class="form-control" name="e-mail" placeholder="Your e-mail">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="sr-only" for="reservation__persons">Number of persons</label>
                      <select class="form-control" id="reservation__persons">
                        <option value="1" selected="">1 Person</option>
                        <option value="2">2 Persons</option>
                        <option value="3">3 Persons</option>
                        <option value="4">4 Persons</option>
                        <option value="5">5 Persons</option>
                        <option value="6">6 Persons</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="reservation__date">Date</label>
                      <input type="date" class="form-control" name="date" id="reservation__date" value="2016-10-09">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="reservation__time">Time</label>
                      <input type="time" class="form-control" id="reservation__time" value="19:00">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-default">Reserve a table</button>
                  </div>
                </div> <!-- .row -->
              </form>
            </div> <!-- .reservation_form_body -->
          </div>
        </div> <!-- .section_row -->
      </section>

      <!-- section map-heading -->
      <section class="section_map-heading" id="section_contacts">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
                <h2 class="map__title">Find us on the map</h2>
                <p class="map__address">10987 1st Avenue, Lorem City, CA</p>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

      <!-- section map -->
      <div class="section_map">
        <div class="section_row">
          <div id="map"></div>
        </div> <!-- / .section_row -->
	  </div>
<?php get_footer(); ?>
