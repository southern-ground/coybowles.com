<?

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'cb_tour',
    array(
      'labels' => array(
        'name' => __( 'Tour Dates' ),
        'singular_name' => __( 'Tour Date' )
      ),
      'public' => true,
      'menu_position' => 5,
    )
  );
}

?>