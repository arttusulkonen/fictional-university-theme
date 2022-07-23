<?php

get_header(); 
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.'
))
?>

<div class="container container--narrow page-section">
        <?php 
          $today = date('Ymd');
          $homepageEvents = new WP_Query(array( 
            'paged' => get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
              )
            )
          ));  
              
          while($homepageEvents->have_posts()) {
            $homepageEvents->the_post(); 
            get_template_part('template-parts/content-event');
             }
             wp_reset_postdata();
            ?>
             <?php echo paginate_links(array(
                 'total' => $homepageEvents->max_num_pages
            )); ?>
  </div>
 
</div>

<?php get_footer();

?> 