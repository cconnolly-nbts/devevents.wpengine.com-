<?php
/*
Template Name: Events List
*/
get_header();
?>
<?php the_post(); ?>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2><?php the_title(); ?></h2>
</div></div></div>
<div id="content" class="pure-g-r">
<div class="pure-u-2-3">
<div class="spacer">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">

<?php 
if ( has_post_thumbnail() ) {
the_post_thumbnail();
} 
?>
<?php 
$args = array( 'post_type' => 'events', 'posts_per_page' => 50, 'orderby'=>'menu_order' );
$loop = new WP_Query( $args );
//events array keeps events so we can sort it by key(date) later
$events = array();
//event_no_date keeps array of events without a date
$events_no_date = array();
while ( $loop->have_posts() ) : $loop->the_post();
  //if custom field says visible
  if (!$post->post_parent && get_post_meta($post->ID, 'event_list', $single = true) == "visible") {
	$title = get_the_title($post->ID);
	$date = get_post_meta($post->ID, 'date_long', $single = true);
	$html = '<h3><a href="';
	$html .= get_permalink($post->ID);
	$html .= '">';
	$html .= get_the_title($post->ID);
	$html .= '</a> - <span style="font-weight: normal;">' . $date . '</span></h3>';
	if(strtotime($date) != False){
		$time = strtotime($date);
		//we make sure an event with the same date doesn't already exist, if it does we add 1 second
		//to the date to differientiate 
		while (isset($events[$time])) {
			$time++;
		}
		$events[$time] = $html;
	}else{
		//add event to event array without a date
		array_push($events_no_date, $html);
	}
	
  }
endwhile; 
//sort events by key low to high
ksort($events);
foreach ($events as $key => $value) {
	echo $value;
}
foreach ($events_no_date as $key => $value) {
	echo $value;
}
wp_reset_query()
?>

</div>
</div>
</div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>