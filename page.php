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
							<style>
								.section_menu .section_title:before { content: "<?php 
																					$title = get_the_title();
																					$title = explode(' ', $title);
																					$last_word = array_pop($title);
																					echo $last_word;
																				?>" }
							</style>
							<h2 class="section_title">&#8722; <?php the_title() ?> &#8722;</h2>
							<hr class="section_title_line">
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

	<!-- section review -->
	<section class="section_review">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h2 class="section_review_title">Lo que dicen nuestros clientes</h2>
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
							<?php endwhile; ?>
						</div> <!-- .carousel_inner -->
					</div>
				</div>
			</div> <!-- .row -->
		</div> <!-- .container -->
	</section>

    <!-- section about -->
	<section class="section_about" id="section_about">
		<?php // Query about section title
			$the_query = new WP_Query( array(
				'post_type' => 'about',
				'tax_query' => array( array( 
					'taxonomy' => 'about_layout',
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

		<?php // Query about rows
			$the_query = new WP_Query( array(
				'post_type' => 'about',
				'meta_key'  => 'about_position',
				'orderby'   => 'meta_value',
				'order'		=> 'ASC',
				'tax_query' => array( array( 
					'taxonomy' => 'about_layout',
					'field' => 'slug',
					'terms' => 'about-title',
					'operator' => 'NOT IN',
				) ),
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

		<?php if ( false ) : ?>
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
		<?php endif; ?>

		<?php if ( false ) : ?>
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
		<?php endif; ?>

      <!-- section gallery -->
      <section class="section_gallery" id="section_gallery">
        <div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php // Query gallery section title
						$the_query = new WP_Query( array(
							'post_type' => 'gallery',
							'tax_query' => array( array(
								'taxonomy' => 'gallery_layout',
								'field' => 'slug',
								'terms' => 'galeria-titulo',
							) ),
						) );

						while ( $the_query->have_posts() ) : $the_query->the_post() ?>
							<style>
								.section_gallery .section_title:before { content: "<?php 
																					$title = get_the_title();
																					$title = explode(' ', $title);
																					$last_word = array_pop($title);
																					echo $last_word;
																				?>" }
							</style>
							<h2 class="section_title">&#8722; <?php the_title() ?> &#8722;</h2>
							<hr class="section_title_line">
							<p class="section_caption">
								<?php the_content() ?>
							</p>
					<?php
						endwhile;
						wp_reset_postdata();
					?>
				</div>
			</div> <!-- .row -->

			<div class="row gallery__grid">
				<?php // Query gallery posts 
					$the_query = new WP_Query( array(
						'post_type' => 'gallery',
						'tax_query' => array( array(
							'taxonomy' => 'gallery_layout',
							'field' => 'slug',
							'terms' => 'galeria-titulo',
							'operator' => 'NOT IN',
						) ),
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

      <!-- section map-heading -->
      <section class="section_map-heading" id="section_contacts">
        <div class="container">
          <div class="row">
			<div class="col-sm-12">
				<style>
					.map__address a{ cursor: pointer; }
				</style>
				<h2 class="map__title">Encontranos en el mapa</h2>
                <p class="map__address"><a id="dot">Dot Baires Shopping</a> | <a id="gurruchaga">Gurruchaga 691</a> | <a id="teresita">Calle 2, 855, Sta Teresita</a> | <a id="bernardo">Chioza 2440, San Bernardo</a></p>
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
