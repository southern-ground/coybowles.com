<?php
/*
Template Name: Tour
*/
get_header(); ?>
  <div class="container blog tour">

<div class="hero hero_blog tour">
  <?php get_template_part( 'nav' ); ?>
  <div class="hero_header">
    <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/tourHeader.png" />
  </div>
</div>

<div class="tour_page">
  <div class="section tour">
    <h1>COY BOWLES AND THE FELLOWSHIP</h1>

    <div class="tour_dates">
	<?php

      $args = array(
        'post_type' => 'cb_tour',
      	'meta_key'  => 'start_date',
      	'orderby'	  => 'meta_value_num',
      	'order'		  => 'ASC'
      );

      $myposts = get_posts( $args );
      foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
        <div class="tour_date">
          <div class="tour_date_date">
            <?php
		$pretty_date = strtotime(get_field('start_date'))
              ?>
              <?php echo date('F j, Y', $pretty_date); ?>
          </div>
          <div class="tour_date_venue">
            <span class="title">
              <?php the_field('venue'); ?>
            </span>
          </div>
          <div class="tour_date_location">
            <span class="venue">
              <?php the_field('location'); ?>
            </span>
          </div>
          <div class="tour_date_info">
            <a href="<?php the_field('info_link'); ?>" target="_blank" class="button">
              Info
            </a>
          </div>
        </div>
      <?php endforeach;
      wp_reset_postdata();?>
    </div>

    <h1>ZAC BROWN BAND</h1>

    <div class="scroll-container scroll-ios">
      <iframe src="http://www.zacbrownband.com/tour"></iframe>
    </div>
  </div>
</div>
<? get_footer(); ?>