<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/favicon/favicon_shami.ico">

	<!-- Facebook sharing -->
	<meta property="og:url" content="http://shami.com.ar"/>
	<meta property="og:title" content="Shami | Arabian food and deli"/>
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="Delicias árabes y shawarma"/>
	<meta property="og:image" content="<?php the_field('facebook_thumbnail') ?>"/>

	<meta name="description" content"Especialidad en Shawarma y comida típica del Medio Oriente."/>

	<title><?php bloginfo('name') ?> | <?php bloginfo('description') ?></title>
	<?php wp_head(); ?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="70">

	<!--  NAVBAR ================================================== -->

  <nav class="navbar navbar-default navbar-fixed-top">
  	<div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar__collapse" aria-expanded="false">
          <span class="sr-only">Menú</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <?php if ( has_custom_logo() ): ?>
          <?php the_custom_logo() ?>
        <?php else: ?>
          <a class="navbar-brand" href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a>
        <?php endif; ?>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar__collapse">
			  <?php bootstrap_nav(); ?>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
