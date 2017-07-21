<?php
/*
Template Name: Photo Gallery
*/
get_header(); ?>
  <div class="container blog gallery">

<div class="hero hero_blog gallery">
  <?php get_template_part( 'nav' ); ?>
  <div class="hero_header">
    <img class="styledHeader" src="<?php echo get_stylesheet_directory_uri(); ?>/img/galleryHeader.png" />
  </div>
</div>

<div class="gallery_page">
  <div class="section gallery">
    <?php if( have_rows('galleries') ): while ( have_rows('galleries') ) : the_row();
      ?><h1><?php echo strtoupper(get_sub_field('title')); ?></h1><?php
        foreach ( get_sub_field( 'gallery' ) as $nextgen_gallery_id ) :
            if ( $nextgen_gallery_id['ngg_form'] == 'album' ) {
                echo nggShowAlbum( $nextgen_gallery_id['ngg_id'] ); //NextGEN Gallery album
            } elseif ( $nextgen_gallery_id['ngg_form'] == 'gallery' ) {
                 echo nggShowGallery( $nextgen_gallery_id['ngg_id'] ); //NextGEN Gallery gallery
            }
        endforeach; endwhile; endif;
    ?>
  </div>
</div>
<? get_footer(); ?>