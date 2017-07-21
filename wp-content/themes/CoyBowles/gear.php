<?php
/*
Template Name: Gear
*/
get_header(); ?>
  <div class="container gear">
<div class="hero hero_gear">
  <?php get_template_part( 'nav' ); ?>

  <div class="hero-banner ibanez">
    <a href="http://www.ibanez.com/products/u_eg_sig_series17.php?year=2017&cat_id=1&series_id=36" target="_blank">
      <img src="http://coybowles.com/wp-content/uploads/2016/11/Ibanez-Banner.jpg" />
    </a>
  </div>

</div>

<div id="videoAnchor" style="text-align:center;">
  <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/gearHeader.png" />
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

  <div class="section feed video_feed" ng-show="ctrl.currentFeed == 'video'" ng-init="ctrl.setYtPlaylist('PLvQEfjwePiNFeCuWTnp-3oRu5kI9o5fSW')">
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


<div class="gear_page">
  <div class="header">
    GUITARS
  </div>
  <div class="section guitars">
    <a ng-hide="ctrl.expandedOpen != null || ctrl.videoOpen != null;" class="guitar_mini_toggle prev" href="javascript:void(0)" ng-click="ctrl.prevMiniGuitarPage($event)"></a>
    <a ng-hide="ctrl.expandedOpen != null || ctrl.videoOpen != null;" class="guitar_mini_toggle next" href="javascript:void(0)" ng-click="ctrl.nextMiniGuitarPage($event)"></a>


    <?php $idx = 0; ?>
    <?php if( have_rows('guitars') ): while ( have_rows('guitars') ) : the_row(); ?>
      <?php $idx = $idx + 1; ?>

      <div ng-init='ctrl.guitars.push({
          id: <?php echo $idx; ?>,
          name: "<?php echo addslashes(get_sub_field('name')) ?>",
          thumbnail: "<?php the_sub_field('thumbnail') ?>"
        })'>
      </div>

      <div class="guitar_img guitars <?php echo $idx == 1 ? 'current' : ''; ?>" ng-hide="ctrl.expandedOpen != null || ctrl.videoOpen != null;" ng-click="ctrl.expandedOpen = <?php echo $idx; ?>;">
        <img src="<?php the_sub_field('thumbnail'); ?>" />
        <div class="hover">
          <span>
          <img class="mini_img" style="display: none" src="<?php echo get_stylesheet_directory_uri(); ?>/img/electric.png"/>
          <?php the_sub_field('name'); ?>
          <br/>
          <?php if(get_sub_field('subtext')) { ?>
            <span class="subtext">
              <?php the_sub_field('subtext'); ?>
            </span>
            <?php } ?></span>
          <?php if(get_sub_field('guitar_type') == 'Electric') { ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/electric.png"/>
          <?php } else { ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/acoustic.png"/>
          <?php } ?>
        </div>
      </div>

      <div class="section video expanded" ng-show="ctrl.videoOpen == <?php echo $idx; ?>">
        <a class="close_icon" ng-click="ctrl.videoOpen = null;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
        </a>
        <div class="exp_header">
          <?php the_sub_field('name'); ?>
        </div>
        <br/>
        <div class="button_wrap">
          <a href="javascript:void(0)" style="margin-right: 20px; display: none" ng-click="ctrl.videoOpen = null" class="button guitar_description_toggle toggle_off">
            - Back
          </a>
        </div>
        <div class="videoWrapper">
          <iframe src="https://www.youtube.com/embed/<?php the_sub_field('video'); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>

      <div class="section guitar_expanded <?php echo $idx; ?>" ng-show="ctrl.expandedOpen == <?php echo $idx; ?>">
        <a class="close_icon" ng-click="ctrl.expandedOpen = null; ctrl.guitarDescOpen = false">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
        </a>
        <div class="exp_header" ng-hide="ctrl.videoOpen">
          <?php the_sub_field('name'); ?>
        </div>
        <div class="section_half" ng-hide="ctrl.guitarDescOpen || ctrl.videoOpen">
          <div class="button_wrap">
            <a href="javascript:void(0)" ng-click="ctrl.guitarDescOpen = true" style="display:none" class="button guitar_description_toggle">
              + Info
            </a>
            <br/>
            <br/>
            <a href="javascript:void(0)" ng-click="ctrl.videoOpen = <?php echo $idx; ?>;" style="display:none" class="button guitar_description_toggle">
              ▶ Video
            </a>
          </div>
          <img class="primary_img" ng-hide="ctrl.gtFlip<?php echo $idx; ?>" src="<?php the_sub_field('front_image') ?>"/>
          <img class="secondary_img" ng-hide="!ctrl.gtFlip<?php echo $idx; ?>" src="<?php the_sub_field('back_image') ?>"/>
        </div><div class="section_half guitar_desc" ng-class="{ open: ctrl.guitarDescOpen }">
          <div class="mini_description description" style="display: none">
            <a href="javascript:void(0)" ng-click="ctrl.guitarDescOpen = false" style="display:none; float: right" class="button guitar_description_toggle toggle_off">
              - Back
            </a>
            <?php the_sub_field('description'); ?>
            <?php the_sub_field('description_2'); ?>
          </div>
          <div class="description" ng-hide="ctrl.desc2Open == <?php echo $idx; ?>">
            <?php the_sub_field('description'); ?>
          </div>
          <div class="description" ng-show="ctrl.desc2Open == <?php echo $idx; ?>">
            <?php the_sub_field('description_2'); ?>
          </div>
          <?php if(get_sub_field('description_2')) { ?>
            <div class="pagin">
              <span ng-hide="ctrl.desc2Open == <?php echo $idx; ?>">1</span><span ng-show="ctrl.desc2Open == <?php echo $idx; ?>">2</span>/2
              <span ng-click="ctrl.desc2Open = null" class="prev"></span>
              <span ng-click="ctrl.desc2Open = <?php echo $idx; ?>" class="next"></span>
            </div>
          <?php } ?>
          <div class="extry_stuff">
            <img ng-click="ctrl.gtFlip<?php echo $idx; ?> = !ctrl.gtFlip<?php echo $idx; ?>;" ng-hide="ctrl.gtFlip<?php echo $idx; ?>" class="back_img" src="<?php the_sub_field('back_image') ?>"/>
            <img ng-click="ctrl.gtFlip<?php echo $idx; ?> = !ctrl.gtFlip<?php echo $idx; ?>;" ng-hide="!ctrl.gtFlip<?php echo $idx; ?>" class="back_img" src="<?php the_sub_field('front_image') ?>"/>
            <div ng-hide="'<?php the_sub_field('video'); ?>'.length == 0" ng-click="ctrl.videoOpen = <?php echo $idx; ?>; ctrl.expandedOpen = null" class="video_img" style="background-image: url(http://img.youtube.com/vi/<?php the_sub_field('video'); ?>/maxresdefault.jpg)">
              <img style="width: 50px;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/play.png" />
            </div>
          </div>
        </div>

        <div class="divider">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/guitarDivider.png" />
        </div>

        <div style="position: relative">
          <a class="guitar_page prev" ng-click="ctrl.prevGuitarPage();"></a>
          <a class="guitar_page next" ng-click="ctrl.nextGuitarPage();"></a>
        </div>
        <div class="resto_images guitar">
          <div class="page" ng-style="{ 'left': -100 * ctrl.guitarPage + '%' }">
            <div ng-repeat="guitar in ctrl.guitars" class="section_quarter">
              <div class="mini_guitar" ng-class="{ selected: ctrl.expandedOpen == guitar.id }" ng-click="ctrl.expandedOpen = guitar.id">
                <img ng-src="{{ guitar.thumbnail }}" />
                <div class="hover">
                  {{ guitar.name }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; endif; ?>
    <div style="clear: both;">
    </div>
  </div>


  <div class="header">
    AMPS
  </div>
  <div class="section guitars amps">
    <a ng-hide="ctrl.expandedAmpOpen != null;" class="guitar_mini_toggle prev" href="javascript:void(0)" ng-click="ctrl.prevMiniGuitarPage($event)"></a>
    <a ng-hide="ctrl.expandedAmpOpen != null;" class="guitar_mini_toggle next" href="javascript:void(0)" ng-click="ctrl.nextMiniGuitarPage($event)"></a>


    <?php $idx = 0; ?>
    <?php if( have_rows('amps') ): while ( have_rows('amps') ) : the_row(); ?>
      <?php $idx = $idx + 1; ?>

      <div ng-init='ctrl.amps.push({
          id: <?php echo $idx; ?>,
          name: "<?php echo addslashes(get_sub_field('name')) ?>",
          thumbnail: "<?php the_sub_field('thumbnail') ?>"
        })'>
      </div>

      <div class="guitar_img amp <?php echo $idx == 1 ? 'current' : ''; ?>" ng-hide="ctrl.expandedAmpOpen != null" ng-click="ctrl.expandedAmpOpen = <?php echo $idx; ?>;">
        <img src="<?php the_sub_field('thumbnail'); ?>" />
        <div class="hover">
          <?php the_sub_field('name'); ?>
        </div>
      </div>

      <div class="section guitar_expanded amp <?php echo $idx; ?>" ng-show="ctrl.expandedAmpOpen == <?php echo $idx; ?>">
        <a class="close_icon" ng-click="ctrl.expandedAmpOpen = null;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
        </a>
        <div class="exp_header">
          <?php the_sub_field('name'); ?>
        </div>

        <p class="desc">
          <?php the_sub_field('description') ?>
        </p>
        <div class="image">
          <img src="<?php the_sub_field('image'); ?>" />
        </div>

        <div class="divider">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/guitarDivider.png" />
        </div>

        <div class="resto_images">
          <div class="page">
            <div ng-repeat="amp in ctrl.amps" class="section_quarter">
              <div class="mini_guitar" ng-class="{ selected: ctrl.expandedAmpOpen == amp.id }" ng-click="ctrl.expandedAmpOpen = amp.id">
                <img ng-src="{{ amp.thumbnail }}" />
                <div class="hover">
                  {{ amp.name }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; endif; ?>
    <div style="clear: both;">
    </div>
  </div>

  <div class="header">
    PEDALS
  </div>
  <div class="section guitars pedals">
    <div class="guitar_img pedal" ng-hide="ctrl.expandedPedalOpen != null || ctrl.videoPedalOpen != null" ng-click="ctrl.expandedPedalOpen = 1;">
      <img src="<?php the_field('main_image'); ?>" />
      <div class="hover">
        Pedals
      </div>
    </div>
    <?php $idx = 0; ?>
    <?php if( have_rows('pedals') ): while ( have_rows('pedals') ) : the_row(); ?>
      <?php $idx = $idx + 1; ?>

      <div ng-init='ctrl.pedals.push({
          id: <?php echo $idx; ?>,
          name: "<?php echo addslashes(get_sub_field('name')) ?>",
          thumbnail: "<?php the_sub_field('thumbnail') ?>"
        })'>
      </div>

      <div class="section video expanded" ng-show="ctrl.videoPedalOpen == <?php echo $idx; ?>">
        <a class="close_icon" ng-click="ctrl.videoPedalOpen = null;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
        </a>
        <div class="exp_header">
          <?php the_sub_field('name'); ?>
        </div>
        <br/>
        <div class="videoWrapper">
          <iframe src="https://www.youtube.com/embed/<?php the_sub_field('video'); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>

      <div class="section guitar_expanded <?php echo $idx; ?>" ng-show="ctrl.expandedPedalOpen == <?php echo $idx; ?>">
        <a class="close_icon" ng-click="ctrl.expandedPedalOpen = null;">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
        </a>
        <div class="exp_header">
          <?php the_sub_field('name'); ?>
        </div>
        <div class="section_half">
          <img src="<?php the_sub_field('front_image') ?>"/>
        </div><div class="section_half guitar_desc">
          <div class="description" ng-hide="ctrl.desc2Open == <?php echo $idx; ?>">
            <?php the_sub_field('description'); ?>
          </div>
          <div class="description" ng-show="ctrl.desc2Open == <?php echo $idx; ?>">
            <?php the_sub_field('description_2'); ?>
          </div>
          <?php if(get_sub_field('description_2')) { ?>
            <div class="pagin">
              <span ng-hide="ctrl.desc2Open == <?php echo $idx; ?>">1</span><span ng-show="ctrl.desc2Open == <?php echo $idx; ?>">2</span>/2
              <span ng-click="ctrl.desc2Open = null" class="prev"></span>
              <span ng-click="ctrl.desc2Open = <?php echo $idx; ?>" class="next"></span>
            </div>
          <?php } ?>
        </div>

        <div class="divider">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/guitarDivider.png" />
        </div>

        <div style="position: relative">
          <a class="guitar_page prev" ng-click="ctrl.prevPedalPage();"></a>
          <a class="guitar_page next" ng-click="ctrl.nextPedalPage();"></a>
        </div>
        <div class="resto_images pedal">
          <div class="page" ng-style="{ 'left': -100 * ctrl.pedalPage + '%' }">
            <div ng-repeat="pedal in ctrl.pedals" class="section_quarter">
              <div class="mini_guitar" ng-class="{ selected: ctrl.expandedPedalOpen == pedal.id }" ng-click="ctrl.expandedPedalOpen = pedal.id">
                <img ng-src="{{ pedal.thumbnail }}" />
                <div class="hover">
                  {{ pedal.name }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; endif; ?>
    <div style="clear: both;">
    </div>
  </div>

  <div class="header">
    SPONSORS
  </div>
  <div class="section sponsors">
    <?php if( have_rows('sponsors') ): while ( have_rows('sponsors') ) : the_row(); ?>
      <a target="_blank" href="<?php the_sub_field('sponsor_link') ?>"><img src="<?php the_sub_field('sponsor_logo'); ?>" /></a>
    <?php endwhile; endif; ?>
  </div>
</div>

<? get_footer(); ?>