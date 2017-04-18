<!-- section map-heading -->
<section class="section_map-heading" id="section_contacts" style="background-image: url(<?php the_field('map_background') ?>)">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <style>
          .map__address li a { cursor: pointer; color: white }
          .section_map-heading .map__title { color: white }
        </style>
        <h2 class="map__title"><?php the_field('map_title') ?></h2>
        <ul class="map__address nav nav-tabs map_nav">
          <li><a id="dot">Dot Baires Shopping</a></li>
          <li><a id="gurruchaga">Gurruchaga 691</a></li>
          <li><a id="teresita">Calle 2, 855, Sta Teresita</a></li>
          <li><a id="bernardo">Chiozza 2440, San Bernardo</a></li>
        </ul>
      </div>
    </div> <!-- .row -->
  </div> <!-- .container -->
</section>

<!-- section map -->
<div class="section_map">
  <div class="section_row">
    <div id="map"></div>
  </div> <!-- .section_row -->
</div>