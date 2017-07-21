<div class="section bio blog_bio" style="display: none; padding-bottom: 20px">
  <img src="<?php the_field('bio_image', get_page_by_title( 'Blog' )->ID); ?>" />
  <p>
    <?php the_field('bio_text', get_page_by_title( 'Blog' )->ID); ?>
  </p>
</div>
<div class="archives">
  <div class="bio_stuff">
    <img class="bio_img" src="<?php the_field('bio_image', get_page_by_title( 'Blog' )->ID); ?>" />
    <p class="bio_text">
      <?php the_field('bio_text', get_page_by_title( 'Blog' )->ID); ?>
    </p>
    <div class="line_spacer"></div>
  </div>
  <h3>
    <?php
    $catt = get_query_var('category_name');
    if(!empty($catt)) {
    ?>
      <a href="<?php echo get_permalink( get_page_by_title( 'Blog' )->ID ); ?>">
        BLOG
      </a>
    <?php } else { ?>
      <a href="<?php echo get_permalink( get_page_by_title( 'Blog' )->ID ); ?>?category_name=articles">
        ARTICLES
      </a>
    <?php } ?>
  </h3>
  <div class="line_spacer"></div>
  <h3>ARCHIVE</h3>
  <?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
  <div class="social_stuff">
    <div class="line_spacer"></div>
    <h3>CONNECT</h3>
    <div class="social">
      <a class="fb" target="_blank" href="https://www.facebook.com/Coy-Bowles-943915212383202/?fref=ts">
      </a>
      <a class="yt" target="_blank" href="https://www.youtube.com/user/coybowles">
      </a>
      <a class="tw" target="_blank" href="https://twitter.com/coybowles">
      </a>
      <a class="ig" target="_blank" href="https://www.instagram.com/coybowles/">
      </a>
    </div>
  </div>
</div>