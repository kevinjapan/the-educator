<?php get_header(); ?>


<?php 

// to do : url is ugly 
// eg "http://localhost/wordpress/wordpress-the-educator/?page_id=2"
// tidy & replace 'page_id' w/ something meaningful.


// we don't show title by default the_title();
// we provide page for 'schools' here

$args = array(
   'hide_empty' => false, // also retrieve terms which are not used yet
   'meta_query' => array(
       array(
          'key'       => 'feature-group',
          'value'     => 'kitchen',
          'compare'   => 'LIKE'
       )
   )
);
?>

<div style="color:lightgrey;margin-top:2rem;margin-bottom:2rem;">page-schools.php</div>


<section class="feature_tiles">
   <ul>
      <?php 
      // 
      // get list of terms for 'te_school' taxonomy
      // rather this than a menu - since menu requires manual configuration.
      //
      $terms = get_terms( array( 
         'taxonomy' => 'te_school',    // exclude all non 'school' taxonomies.
         'parent'   => 0,              // top-level only
         'hide_empty' => false,         // show all regardless
         'key'       => 'feature-group',
         'value'     => 'kitchen',
         'compare'   => 'LIKE'
   ) );

      foreach($terms as $term) {
         ?>
         <li>
            <h3>
               <a href="<?php echo get_term_link($term->name,'te_school'); ?>"><?php echo $term->name;?></a>
            </h3>
            <p>
               <?php
                  //echo get_term_meta( $term->term_id, 'te_text', true )

                  $image = get_term_meta($term->term_id, 'category_image', true);
                  echo '<img src="'.$image.'" />';

               ?>
            </p>

            <img src="<?php the_post_thumbnail_url('large'); ?>"/>

         </li>
         <?php
      }
      ?>
   </ul>
</section>

<?php 
   if(have_posts()) :
      while(have_posts()) :

         the_post();
         the_content();

      endwhile; 
   endif;
?>


<?php get_footer(); ?>