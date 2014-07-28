<?php
/*
Template Name: Our Partners
*/
get_header();
?>
<?php the_post(); ?>
<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2><?php the_title(); ?></h2>
</div></div></div>
<div id="content" class="pure-g-r">
<div class="pure-u-1">
<div class="spacer">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
  
<?php the_content(); ?>
  

<style>
.isotopeItem, .isotopeItem2 { margin: 0 10px 10px 0; padding: 10px; max-width: 200px; float: left;}
.isotopeItem, .isotopeItem2 img { max-width: 190px; }
#filters { margin-bottom: 10px; font-size: 13px; }
</style>

<p>Use the dropdown below to show the sponsors for a specific event, or show all sponsors.</p>

<?php
$terms = get_terms( 'event_association' ); 
echo '<form class="pure-form">';
echo '<select id="filters">';
echo '<option data-filter="*" selected="selected">Show All</option>';
foreach ($terms as $term) {
  echo '<option data-filter=".' . $term->slug . '">' . $term->name . '</option>';
}
echo '</select>';
echo '</form>';
?>


<h3 class="sponsor">Sponsors</h3>

<div id="isotopeContainer">
  <?php  
  //$loop = new WP_Query( 'post_type=sponsors&orderby=title&order=asc' );
  $loop = new WP_Query(array(
  'post_type' => array('sponsors', 'bronze_sponsors'),
  'orderby' => 'title',
  'order' => 'ASC'
));
  while ( $loop->have_posts() ) : $loop->the_post();
    $term_list = wp_get_post_terms($post->ID, 'event_association', array("fields" => "slugs"));
    echo '<div class="isotopeItem';
      foreach ($term_list as $class) {
        echo ' ' . $class;
      }
    echo'">';
    if (get_post_meta($post->ID, 'sponsor_url', $single = true)) {
    echo '<a href="';
    echo get_post_meta($post->ID, 'sponsor_url', $single = true);
    echo '" target="_blank" alt="';
    the_title();
    echo '">';
    }
    if ( has_post_thumbnail() ) { the_post_thumbnail(); } else { echo '<h2>'; the_title(); echo '</h2>'; };
    if (get_post_meta($post->ID, 'sponsor_url', $single = true)) {
    echo '</a>';
    }
    echo '</div>';
  endwhile; 
  wp_reset_query();

  ?>
</div>


<h3 class="sponsor">Partners</h3>
<div id="isotopeContainer">
  <?php  
  //$loop = new WP_Query( 'post_type=partners&orderby=title&order=asc' );
  $loop2 = new WP_Query(array(
  'post_type' => array('partners', 'media_partners'),
  'orderby' => 'title',
  'order' => 'ASC'
));

  while ( $loop2->have_posts() ) : $loop2->the_post();
    $term_list = wp_get_post_terms($post->ID, 'event_association', array("fields" => "slugs"));
    echo '<div class="isotopeItem2';
      foreach ($term_list as $class) {
        echo ' ' . $class;
      }
    echo'">';
    
    if ( has_post_thumbnail() ) { the_post_thumbnail(); } else { echo '<h2>'; the_title(); echo '</h2>'; };
    if (get_post_meta($post->ID, 'partners_url', $single = true)) {
    echo '</a>';
    }
    echo '</div>';
  endwhile; 
  wp_reset_query();
  ?>
</div>


</div>
</div>
</div>
</div>
</div>

 

<?php get_footer(); ?>
