<?php
/*
Template Name: About
*/
get_header(); ?>
<div class="container about">

<div class="hero hero_about">
  <?php get_template_part( 'nav' ); ?>
</div>

<div style="text-align:center;margin-bottom: 20px">
  <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/aboutHeader.png" />
</div>

<div class="about_page">
  <div class="section writing">
    <div class="section_half">
      <h2>COY BOWLES</h2>
      <div style="text-align:center;">
        <img style="margin-bottom: 10px" class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      </div>
      <p>
        <?php if( have_rows('about_coy') ): while ( have_rows('about_coy') ) : the_row(); ?>
          <span class="hilite"><?php the_sub_field('label') ?> |</span> <?php the_sub_field('description'); ?>
          <br/>
          <br/>
        <?php endwhile; endif; ?>
      </p>
    </div><div class="section_half img_section" style="background-image: url(<?php the_field('about_image'); ?>)">
    </div>
  </div>

  <div class="section" ng-hide="ctrl.musicExpanded == true">
    <div class="section_half">
      <h2>MUSICAL CAREER</h2>
      <div style="text-align:center;">
        <img style="margin-bottom: 10px" class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      </div>
      <div class="musical_descrip">
        <p>
          <?php the_field('musical'); ?>
        </p>
      </div>
      <p>
        <a class="pull-right" style="clear:both" href="javascript:void(0)" ng-click="ctrl.musicExpanded = true">
          READ MORE
          <img class="readmore" height="20" src="<?php echo get_stylesheet_directory_uri(); ?>/img/pageArrow.png" />
        </a>
        <br/>
      </p>
      <div class="button_wrap">
        <a href="<?php echo get_permalink( get_page_by_title( 'Tour' )->ID ); ?>" class="button">SEE WHERE I'M PLAYING</a>
      </div>
    </div><div style="position: relative" class="section_half">
      <img class="about_big" src="<?php the_field('musical_image'); ?>" />
      <p class="influences">
        <span class="header">Influences</span>
        <span style="display: block; text-align: center;">
          <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
        </span>
        <br/>
        <?php if( have_rows('influences') ): while ( have_rows('influences') ) : the_row(); ?>
          <span class="hilite"><?php the_sub_field('label') ?> |</span> <?php the_sub_field('description'); ?>
          <br/>
          <br/>
        <?php endwhile; endif; ?>
      </p>
    </div>
  </div>

  <div class="section expanded" ng-show="ctrl.musicExpanded == true">
    <p style="position: absolute;right: -10px;">
      <a class="close_icon" ng-click="ctrl.musicExpanded = false">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
      </a>
    </p>
    <div class="section_half">
      <h2>MUSICAL CAREER</h2>
      <div style="text-align:center;">
        <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      </div>
      <?php
      $text = get_field('musical');

      $splitstring1 = substr($text, 0, floor(strlen($text) / 2));
      $splitstring2 = substr($text, floor(strlen($text) / 2));

      if (substr($splitstring1, 0, -1) != ' ' AND substr($splitstring2, 0, 1) != ' ')
      {
          $middle = strlen($splitstring1) + strpos($splitstring2, ' ') + 1;
      }
      else
      {
          $middle = strrpos(substr($text, 0, floor(strlen($text) / 2)), ' ') + 1;
      }

      $string1 = substr($text, 0, $middle);  // "The Quick : Brown Fox Jumped "
      $string2 = substr($text, $middle);  // "Over The Lazy / Dog"

      ?>



      <p>
        <?php echo $string1; ?>
      </p>
    </div><div class="section_half" style="margin-top: 90px">
      <p>
        <?php echo $string2; ?>
      </p>
      <div class="button_wrap">
        <a href="<?php echo get_permalink( get_page_by_title( 'Tour' )->ID ); ?>" class="button">SEE WHERE I'M PLAYING</a>
      </div>
    </div>
  </div>

  <div class="section writing">
    <div class="section_half">
      <h2>WRITING</h2>
      <div style="text-align:center;">
        <img style="margin-bottom: 10px" class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      </div>
      <p>
        <?php the_field('writing'); ?>
      </p>
      <div class="button_wrap">
        <a href="<?php echo get_permalink( get_page_by_title( 'Books' )->ID ); ?>" class="button">LATEST PROJECTS</a>
      </div>
    </div><div class="section_half img_section" style="background-image: url(<?php the_field('writing_image'); ?>);">
    </div>
  </div>

</div>
<? get_footer(); ?>