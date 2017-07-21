<?php
/*
Template Name: Books
*/
get_header(); ?>
  <div class="container books">
<div class="hero hero_books">
  <?php get_template_part( 'nav' ); ?>
</div>

<div id="videoAnchor" style="text-align:center;">
  <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/booksHeader.png" />
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

  <div class="section feed video_feed" ng-show="ctrl.currentFeed == 'video'" ng-init="ctrl.setYtPlaylist('PLvQEfjwePiNF3fktKnH3cAAMm37KZVhxg')">
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

<div class="books_page">

  <div class="section bio">
    <img src="<?php the_field('bio_image'); ?>" />
    <p>
      <?php the_field('bio_description'); ?>
      <span class="sig">
        - Coy Bowles
      </span>
    </p>
  </div>

  <?php
  if( have_rows('book_entries') ):
    while ( have_rows('book_entries') ) : the_row();
    ?>
      <div class="section">
        <div class="section_half">
          <div class="titles">
            <div class="main_title">
              <?php the_sub_field('title'); ?>
            </div>
            <div class="sub_title">
              <?php the_sub_field('sub_title'); ?>
            </div>
            <div class="authors">
              <?php the_sub_field('authors'); ?>
            </div>
          </div>
          <div class="description">
            <?php the_sub_field('description'); ?>
          </div>
          <div class="button_wrap">
            <a class="button" target="_blank" href="<?php the_sub_field('button_link'); ?>">
              <?php the_sub_field('button_text'); ?>
            </a>
            <?php if(get_sub_field('amazon_link')) { ?>
              <a target="_blank" href="<?php the_sub_field('amazon_link'); ?>">
                <img class="retail_link" src="https://images-na.ssl-images-amazon.com/images/G/01/associates/remote-buy-box/buy5._V192207739_.gif" />
              </a>
            <?php } ?>
            <?php if(get_sub_field('barnes_link')) { ?>
              <a target="_blank" href="<?php the_sub_field('barnes_link'); ?>">
                <img class="retail_link" src="<?php echo get_stylesheet_directory_uri(); ?>/img/barnesButton.png"/>
              </a>
            <?php } ?>
          </div>
        </div><div class="section_half" style="background-color: #EEE5D7">
          <img src="<?php the_sub_field('main_image'); ?>"/>
        </div>
        <div class="extra_images clearfix">
          <?php
          if( have_rows('extra_images') ):
            while ( have_rows('extra_images') ) : the_row();
            ?>
            <img class="extra_image" src="<?php the_sub_field('image'); ?>"/>
              <?php
              endwhile;
            endif;
            ?>
        </div>

	<?php if(get_sub_field('extended_copy')){?>
          <div class="extended_copy clearfix">
		<?php the_sub_field('extended_copy'); ?>
          </div>
      <?php } ?>

      </div>      
    <?php
    endwhile;
  endif;
  ?>

  <div style="text-align:center;margin:200px 0 30px">
    <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/writingHeader.png" />
  </div>

    <div class="section blogs">
      <div class="section_half">
        <div class="main_title titles">
          Blogs
        </div>
        <div class="description">
          <?php the_field('blogs_description'); ?>
        </div>
        <div class="button_wrap">
          <a class="button" href="<?php echo get_permalink( get_page_by_title( 'Blog' )->ID ); ?>">
            GO TO BLOG
          </a>
        </div>
        <?php
        $last = wp_get_recent_posts( '1');
        $last_id = $last['0']['ID'];
        ?>

      </div><div class="section_half img_section" style="background-color: #EEE5D7; background: url(<?php the_field('hero_image', $last_id); ?>); background-size: cover; background-position: 50% 50%;">
        <a class="post_link" href="<?php echo get_permalink($last_id); ?>">
          <span><?php echo $last['0']['post_title']; ?></span>
        </a>
      </div>
    </div>

  <div style="text-align:center;margin:200px 0 30px">
    <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/charitiesHeader.png" />
  </div>

  <?php
  if( have_rows('charity_entries') ):
    while ( have_rows('charity_entries') ) : the_row();
    ?>
      <div class="section">
        <div class="section_half">
          <div class="titles">
            <div class="main_title">
              <?php the_sub_field('title'); ?>
            </div>
            <div class="sub_title">
              <?php the_sub_field('sub_title'); ?>
            </div>
          </div>
          <div class="description">
            <?php the_sub_field('description'); ?>
          </div>
          <div class="button_wrap">
            <a class="button" target="_blank" href="<?php the_sub_field('button_link'); ?>">
              <?php the_sub_field('button_text'); ?>
            </a>
          </div>
        </div><div class="section_half" style="background-color: #EEE5D7">
          <img src="<?php the_sub_field('main_image'); ?>"/>
        </div>
      </div>
    <?php
    endwhile;
  endif;
  ?>

</div>

<? get_footer(); ?>