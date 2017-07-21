<?php
/*
Template Name: Home
*/
get_header(); ?>
  <div class="container home_page">
<div class="hero">
  <?php get_template_part( 'nav' ); ?>
  <!--<div class="hero-banner book">
      <img src="http://coybowles.com/wp-content/uploads/2016/12/banner-when-youre-feeling-sick.jpg" />
  </div>-->
</div>

<div class="feed_tabs">
  <img class="bookend" src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialStart.png" />
  <a ng-class="{ 'active': ctrl.currentFeed == 'facebook' }" ng-click="ctrl.changeFeed('facebook')">
    Facebook
  </a>
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialDivider.png" />
  <a ng-class="{ 'active': ctrl.currentFeed == 'blog' }" ng-click="ctrl.changeFeed('blog')">
    Blog
  </a>
  <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialDivider.png" />
  <a ng-class="{ 'active': ctrl.currentFeed == 'video' }" ng-click="ctrl.changeFeed('video')">
    Youtube
  </a>
  <img class="bookend" src="<?php echo get_stylesheet_directory_uri(); ?>/img/socialEnd.png" />
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

  <div class="section feed video_feed" ng-show="ctrl.currentFeed == 'video'" ng-init="ctrl.setYtPlaylist('PLvQEfjwePiNF84eZneMyrkalqLjV9JzxB')">
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

  <div class="section feed facebook_feed" ng-show="ctrl.currentFeed == 'facebook'">
    <div class="page" ng-style="{ 'left': -100 * ctrl.mainPage + '%' }">
      <div class="section_half facebook" ng-repeat="post in ctrl.posts" ng-click="ctrl.fbLink(post.id)">
        <img data-ng-if="post.img" class="facebook_bg" ng-src="{{ post.img }}">
        <p ng-style="{ 'margin-top': ( !post.text ? '6.5vw' : '20px') }">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebookFeed.png" />
        </p>
        <p>
          {{ post.text | truncate:150 }}
        </p>
      </div>
    </div>
  </div>

  <div class="section feed blog_feed" ng-show="ctrl.currentFeed == 'blog'">
    <div class="page" ng-style="{ 'left': -100 * ctrl.mainPage + '%' }">
      <?php
      $args = array( 'posts_per_page' => 12 );

      $myposts = get_posts( $args );
      foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
      	<div class="section_half blog" style="background-image:url(<?php the_field('hero_image'); ?>)">
          <a href="<?php the_permalink(); ?>"></a>
          <p>
            <?php the_title(); ?>
          </p>
        </div>
      <?php endforeach;
      wp_reset_postdata();?>
    </div>
  </div>
</div>

<div class="section" ng-init="ctrl.getFirstPlaylistItem('music', 'PLvQEfjwePiNG-98Yz8BxIpWPnZ21b-mFR')">
  <div>
    <a href="<?php echo get_permalink( get_page_by_title( 'Music' )->ID ); ?>"><img class="section_half" src="<?php echo get_stylesheet_directory_uri(); ?>/img/musicHero.png" /></a><div class="section_half text">
      <div class="exp"
        ng-if="ctrl['video-music']"
        ng-style="{ 'background-image': 'url(http://img.youtube.com/vi/{{ ctrl['video-music'].id }}/maxresdefault.jpg)' }">
        <a href="<?php echo get_permalink( get_page_by_title( 'Music' )->ID ); ?>?openVideos=true#videoAnchor">
          <img class="playBtn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play.png" />
        </a>
      </div>
      <p>
        {{ ctrl['video-music'].title }}
      </p>
    </div>
  </div>
</div>

<div class="section" ng-init="ctrl.getFirstPlaylistItem('books', 'PLvQEfjwePiNF3fktKnH3cAAMm37KZVhxg')">
  <div>
    <a href="<?php echo get_permalink( get_page_by_title( 'Books' )->ID ); ?>"><img class="section_half" src="<?php echo get_stylesheet_directory_uri(); ?>/img/booksHero.png" /></a><div class="section_half text">
      <div class="exp"
        ng-if="ctrl['video-books']"
        ng-style="{ 'background-image': 'url(http://img.youtube.com/vi/{{ ctrl['video-books'].id }}/maxresdefault.jpg)' }">
        <a href="<?php echo get_permalink( get_page_by_title( 'Books' )->ID ); ?>?openVideos=true#videoAnchor">
          <img class="playBtn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play.png" />
        </a>
      </div>
      <p>
        {{ ctrl['video-books'].title }}
      </p>
    </div>
  </div>
</div>

<div class="section" ng-init="ctrl.getFirstPlaylistItem('gear', 'PLvQEfjwePiNFeCuWTnp-3oRu5kI9o5fSW')">
  <div>
    <a href="<?php echo get_permalink( get_page_by_title( 'Gear' )->ID ); ?>"><img class="section_half" src="<?php echo get_stylesheet_directory_uri(); ?>/img/gearHero.png" /></a><div class="section_half text">
      <div class="exp"
        ng-if="ctrl['video-gear']"
        ng-style="{ 'background-image': 'url(http://img.youtube.com/vi/{{ ctrl['video-gear'].id }}/maxresdefault.jpg)' }">
        <a href="<?php echo get_permalink( get_page_by_title( 'Gear' )->ID ); ?>?openVideos=true#videoAnchor">
          <img class="playBtn" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play.png" />
        </a>
      </div>
      <p>
        {{ ctrl['video-gear'].title }}
      </p>
    </div>
  </div>
</div>

<? get_footer(); ?>