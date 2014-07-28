<?php
/*
Template Name: Event Detail
*/

require_once('ConvioOpenAPI.php');
$convioAPI = new ConvioOpenAPI;
$convioAPI->host       = 'secure2.convio.net';
$convioAPI->short_name = 'bts';
$convioAPI->api_key    = 'thooG9Ke';
$convioAPI->response_format = 'xml';
if (get_post_meta($post->ID, 'external_url', $single = true)) {
	header( 'Location: ' .  get_post_meta($post->ID, 'external_url', $single = true)) ;
}
if ($post->post_parent) {
	$fr_id = get_post_meta($post->post_parent, 'fr_id', $single = true);
	$fr_name = get_post_meta($post->post_parent, 'fr_name', $single = true);
	$event_type = get_post_meta($post->post_parent, 'event_type', $single = true);
	$fb_url = get_post_meta($post->post_parent, 'fb_url', $single = true);
	$registration_time = get_post_meta($post->post_parent, 'registration_time', $single = true);
	$program = get_post_meta($post->post_parent, 'program', $single = true);
	$event_length = get_post_meta($post->post_parent, 'event_length', $single = true);
} else {
	$fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
	$fr_name = get_post_meta($post->ID, 'fr_name', $single = true);
	$event_type = get_post_meta($post->ID, 'event_type', $single = true);
	$date_long= get_post_meta($post->ID, 'date_long', true);
	$fb_url = get_post_meta($post->ID, 'fb_url', $single = true);
	$registration_time = get_post_meta($post->ID, 'registration_time', $single = true);
	$program = get_post_meta($post->ID, 'program', $single = true);
	$event_length = get_post_meta($post->ID, 'event_length', $single = true);
	
}
$parent_title = get_the_title($post->post_parent);
$params = array('name' => $fr_name, 'event_type' => 'TeamraiserEvents');
$response = $convioAPI->call('CRTeamraiserAPI_getTeamraisersByInfo', $params);
$tr_xml = simplexml_load_string($response);
$event_date = date("l, F j, Y", strtotime($tr_xml->teamraiser->event_date));
$location_name = $tr_xml->teamraiser->location_name;
$event_city = $tr_xml->teamraiser->city;
$event_state = $tr_xml->teamraiser->state;
$donations = $tr_xml->teamraiser->accepting_donations;
$registrations = $tr_xml->teamraiser->accepting_registrations;
get_header(); 
?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php if(empty( $post->post_parent )): ?>
		<script>
		$.cookie('event_cookie', '<?php the_permalink() ?>', { expires: 1, path: '/' });
		</script>
	<?php endif; ?>

	<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>
<div class="pure-g-r" id="titleBar">
	<div class="titleContainer">
		<div class="spacer">

<?php 
		if ($post->post_parent) {
			echo '<div class="pure-u-1">';
		}
		else{
			echo '<div class="pure-u-2-3 TitleCol1">';
		}

			?>
		


		<h2 class="eventTitle"><?php the_title(); ?><?php if ($post->post_parent) { echo ": " . $parent_title; } ?></h2>
		<?php 
		echo '<b>Date:</b>' $event_date;
		echo '<b>Location:</b>' $location_name;
		echo '<b>Registration:</b>' $registration_time;
		echo '<b>Program & Activities:</b>' $program;
		echo '<b>Length of Event:</b>' $event_length;
		?>
	</div>


		<div class="pure-u-1-3 TitleCol2">
		<div class="eventCountdown">
		<?php 
		if ($post->post_parent) {
		
		}
		else{
			if (('events' == get_post_type())    && ( $date_long != 'Coming Soon!' )) { 

			echo do_shortcode('[ujicountdown id="Houston" expire="'. $date_long . ' 12:00"]');}
		}

			?>

	
		</div>
		</div>

		</div>
	</div>
</div>

	<div id="content" class="pure-g-r event-details">
		<div class="pure-u-2-3">
			<div class="spacer">
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
		</div></div>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer(); ?>