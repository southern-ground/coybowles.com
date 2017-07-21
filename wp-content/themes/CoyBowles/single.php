<?php get_header(); ?>
  <div class="container blog">
<div class="hero hero_blog">
  <?php get_template_part( 'nav' ); ?>
  <div class="hero_header">
    <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogHeader.png" />
  </div>
</div>

<?php get_template_part( 'blog_side' ); ?>

<div class="blog_page posts">
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  	<div class="section post">
      <a href="<?php echo get_permalink( get_page_by_title( 'Blog' )->ID ); ?>" class="close_icon pull-right" style="margin: 0">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/closeButton.png" />
      </a>
      <br/>
      <a href="<?php the_permalink(); ?>">
        <h2>
          <?php the_title(); ?>
        </h2>
      </a>
      <p>
        Posted on <?php the_date(); ?>
      </p>
      <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogDivider.png" />
      <br/>
      <br/>
      <div class="hero_img_wrapper">
        <img class="hero_img" src="<?php the_field('hero_image'); ?>" />
      </div>

      <div class="content">
        <?php the_content();?>
      </div>
    </div>
  <?php endwhile; endif; ?>
</div>


<? get_footer(); ?>