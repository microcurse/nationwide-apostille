<?php
$args = array(
  'post_type'   => 'states',
  'post_status' => 'publish',
  'tax_query'   =>  array(
    array(
      'taxonomy'  =>  'state',
      'field'     =>  'slug',
      'terms'     =>  'states'
    )
  )
);

$testimonials = new WP_Query( $args );
if( $testimonials->have_posts() ):
?>
  <ul>
  <?php
    while( $states->have_posts() ) :
      $states->the_post();
      ?>
        <li><?php printf( '%1$s - %2$s', get_the_title(), get_the_content() ); ?></li>
        <?php
        endwhile;
        wp_reset_postdata();
      ?>
  </ul>
<?php
else :
  esc_html_( 'No states in the state taxonomy', 'text-domain' );
endif;
?>