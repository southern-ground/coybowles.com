<?php
/*
Template Name: Music
*/
get_header(); ?>
  <div class="container music">
<div class="hero hero_music">
  <?php get_template_part( 'nav' ); ?>
</div>

<div id="videoAnchor" style="text-align:center;">
  <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicHeader.png" />
</div>

<div class="feed_wrapper expanded" ng-show="ctrl.feedExpanded">
  <a class="page_link prev" ng-click="ctrl.prevMiniPage();"></a>
  <a class="page_link next" ng-click="ctrl.nextMiniPage();"></a>
  <div class="section feed expanded">
    <p>
      <a class="close_icon" ng-click="ctrl.hideExpanded()">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
      </a>
    </p>
    <div class="videoWrapper">
      <iframe ng-src="{{ ctrl.currentVideoSrc }}">
      </iframe>
    </div>

    <div class="mini_feed">
      <div class="page" ng-style="{ 'left': -100 * ctrl.miniPage + '%' }">
        <div class="section_quarter video"
          ng-click="ctrl.showVideo(video.id);"
          ng-repeat="video in ctrl.videos"
          ng-style="{ 'background-image': 'url(http://img.youtube.com/vi/{{ video.id }}/maxresdefault.jpg)' }">
          <p>
           {{ video.title }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="feed_wrapper" ng-hide="ctrl.feedExpanded">
  <a class="page_link prev" ng-click="ctrl.prevMainPage();"></a>
  <a class="page_link next" ng-click="ctrl.nextMainPage();"></a>

  <div class="section feed video_feed" ng-show="ctrl.currentFeed == 'video'" ng-init="ctrl.setYtPlaylist('PLvQEfjwePiNG-98Yz8BxIpWPnZ21b-mFR')">
    <div class="page" ng-style="{ 'left': -100 * ctrl.mainPage + '%' }">
      <div class="section_half video"
        ng-click="ctrl.showVideo(video.id);"
        ng-repeat="video in ctrl.videos"
        ng-style="{ 'background-image': 'url(http://img.youtube.com/vi/{{ video.id }}/maxresdefault.jpg)' }">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/play.png" />

        <p>
         {{ video.title }}
        </p>
      </div>
    </div>
  </div>
</div>

<div class="section transparent">
  <iframe width="100%" height="400" style="margin: 0 auto;" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/7235115&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
</div>

<div class="music_page">
  <div class="section zbb">
    <div style="position: relative">
      <img class="music_hero" src="<?php the_field('zbb_hero'); ?>" />
      <div class="button_wrapper">
        <a href="<?php echo get_permalink( get_page_by_title( 'Tour' )->ID ); ?>" class="button">
          TOUR DATES
        </a>
        <a class="button" target="_blank" href="https://www.youtube.com/user/zacbrownband">
          VIDEOS &#9654;
        </a>
      </div>
    </div>
    <div class="section_half white">
      <h2>ZAC BROWN BAND</h2>
      <img style="vertical-align: middle" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      <p>
        <?php the_field('zbb_description'); ?>
        <p><strong>Over the years ZBB has performed with many musicians including:</strong></p>
        <p>
        <?php if( have_rows('performers') ): while ( have_rows('performers') ) : the_row(); ?>
            <span class="performer">
              <?php the_sub_field('performer_name') ?>
            </span>
        <?php endwhile; endif; ?>
        </p>
      </p>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />
    </div><div class="section_half ">
      <h3>Coy has writing credits on the following ZBB albums:</h3>
      <table class="music_list">
        <?php if( have_rows('zbb_records') ): while ( have_rows('zbb_records') ) : the_row(); ?>
          <tr>
            <td>
              <img src="<?php the_sub_field('record_image') ?>" />
            </td>
            <td>
              <h4><?php the_sub_field('record_name') ?></h4>
              <?php if( have_rows('songs') ): while ( have_rows('songs') ) : the_row(); ?>
                <p><?php the_sub_field('song_name'); ?></p>
              <?php endwhile; endif; ?>
            </td>
          </tr>
        <?php endwhile; endif; ?>
      </table>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />

    </div>
  </div>

  <div class="section zbb fellowship">
    <div style="position: relative">
      <img class="music_hero" src="<?php the_field('fellowship_hero'); ?>" />
      <div class="button_wrapper">
        <a href="<?php echo get_permalink( get_page_by_title( 'Tour' )->ID ); ?>" class="button">
          TOUR DATES
        </a>
        <a class="button" target="_blank" href="https://www.youtube.com/user/BowlesCoy">
          VIDEOS &#9654;
        </a>
      </div>
    </div>
    <div class="section_half white">
      <h2>COY BOWLES</h2>
      <p class="fellowship_sub">and the fellowship</p>
      <img style="vertical-align: middle" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      <p>
        <?php the_field('fellowship_description'); ?>
      </p>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />
    </div><div class="section_half">
      <table class="music_list">
        <?php if( have_rows('fellowship_records') ): while ( have_rows('fellowship_records') ) : the_row(); ?>
          <tr>
            <td>
              <img src="<?php the_sub_field('record_image') ?>" />
            </td>
            <td>
              <h4><?php the_sub_field('record_name') ?></h4>
              <?php if( have_rows('songs') ): while ( have_rows('songs') ) : the_row(); ?>
                <p><?php the_sub_field('song_name'); ?></p>
              <?php endwhile; endif; ?>
            </td>
          </tr>
        <?php endwhile; endif; ?>
      </table>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />

    </div>
  </div>

  <div class="section zbb lessons">
    <div style="position: relative">
      <img class="music_hero" src="<?php the_field('music_lessons_hero'); ?>" />
      <div class="button_wrapper">
        <?php if(get_field('lessons_videos')) { ?>
          <a class="button" target="_blank" href="<?php the_field('lessons_videos'); ?>">
            VIDEOS &#9654;
          </a>
        <?php } ?>
      </div>
    </div>
    <div class="section_half white">
      <h2>MUSIC LESSONS</h2>
      <img style="vertical-align: middle" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider.png" />
      <p>
        <?php the_field('music_lessons_description'); ?>
      </p>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />
    </div><div class="section_half" style="padding-top: 30px; padding-bottom: 50px">
      <h4>BASIC THEORY 101</h4>
      <a href="<?php the_field('basic_theory_download'); ?>" target="_blank" download>DOWNLOAD LESSON PLAN</a>
      <br/>
      <br/>
      <h4>BASIC CHORDS</h4>
      <a href="<?php the_field('basic_chords_download'); ?>" target="_blank" download>DOWNLOAD LESSON PLAN</a>
      <br/>
      <br/>
      <h4>NOTES ON A FRETBOARD</h4>
      <a href="<?php the_field('notes_on_a_fretboard_download'); ?>" target="_blank" download>DOWNLOAD LESSON PLAN</a>
      <img class="lil_divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicDivider2.png" />
    </div>
  </div>
</div>


<? get_footer(); ?>