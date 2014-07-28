<div class="pure-u-1-3 ">
<div class="spacer">
<aside id="sidebar">
	
<?php	
require_once('ConvioOpenAPI.php');
$convioAPI = new ConvioOpenAPI;
$convioAPI->host       = 'secure2.convio.net';
$convioAPI->short_name = 'bts';
$convioAPI->api_key    = 'thooG9Ke';
$convioAPI->response_format = 'xml';
if ($post->post_parent) {
$fr_id = get_post_meta($post->post_parent, 'fr_id', $single = true);
$fr_name = get_post_meta($post->post_parent, 'fr_name', $single = true);
$event_type = get_post_meta($post->post_parent, 'event_type', $single = true);
$event_association = wp_get_post_terms( $post->post_parent, 'event_association');
} else {
$fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
$fr_name = get_post_meta($post->ID, 'fr_name', $single = true);
$event_type = get_post_meta($post->ID, 'event_type', $single = true);
$event_association = wp_get_post_terms( $post->ID, 'event_association');
}
$sponsor_count = 0;
foreach ($event_association as $field) {
    	$sponsor_count++;
    	$slug .= $field->slug;
}
$parent_title = get_the_title($post->post_parent);
$params = array('name' => $fr_name, 'event_type' => 'TeamraiserEvents');
$response = $convioAPI->call('CRTeamraiserAPI_getTeamraisersByInfo', $params);
$tr_xml = simplexml_load_string($response);
$event_date = date("l, F j, Y,", strtotime($tr_xml->teamraiser->event_date));
$location_name = $tr_xml->teamraiser->location_name;
$event_city = $tr_xml->teamraiser->city;
$event_state = $tr_xml->teamraiser->state;
$donations = $tr_xml->teamraiser->accepting_donations;
$registrations = $tr_xml->teamraiser->accepting_registrations;

echo '<div class="sidebar-buttons">';
if ('events' == get_post_type()) { ?>
<?php if ($registrations && $registrations == 'false'){} else { ?><a class="registerButton pure-button" href="http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?>"><strong>REGISTER</strong><?php if ($event_type) { echo ' TO ' . $event_type; } ?></a><?php } ?>
<?php } ?>
<?php if ($donations && $donations == 'false'){} else { ?><a class="<?php if ('events' == get_post_type()) { ?>donateButton<?php } else { ?>registerButton<?php } ?> pure-button" href="<?php if ('events' == get_post_type()) { ?>http://www.braintumorcommunity.org/site/TR/Events/?fr_id=<?php echo $fr_id; ?>&pg=pfind<?php } else { ?>/donate/<?php } ?>"><strong>DONATE</strong><?php if ('events' == get_post_type()) { echo ' TO A PARTICIPANT';} ?></a><?php } ?>
<?php if ($registrations && $registrations == 'false'){} else { ?><a class="signupButton pure-button" href="<?php if ('events' == get_post_type()) { ?>http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?><?php } else { ?>/volunteer-information/<?php } ?>"><strong>SIGN UP</strong> TO VOLUNTEER</a><?php } ?>
<a class="becomeButton pure-button" href="/become-a-sponsor/"><strong>BECOME</strong> A SPONSOR</a> 
</div>
<?php 
if ('events' == get_post_type()) {
	if ($sponsor_count != 0) {
	echo '<h3 class="sponsorTitle">Thank you to our sponsors</h3><div class="sponsorSlide">';
	$loop = new WP_Query( 'post_type=sponsors&orderby=title&order=asc&event_association=' . $slug );
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<div class="sliderItem">';
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
	echo '</div>';
	}
} else {
	echo '<h3 class="sponsorTitle">Thank you to our sponsors</h3><div class="sponsorSlide">';
	$args = array( 'post_type' => 'sponsors', 'orderby' => 'title', 'order' => 'asc' );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		echo '<div class="sliderItem">';
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
	echo '</div>';
} ?>
<?php if ('events' == get_post_type()) { ?>
<iframe style="padding-bottom: 20px;" src="http://www.braintumorcommunity.org/site/PageServer?pagename=pbAPITopFundraisers&s_frid=<?php echo $fr_id; ?>" frameborder="0" allowtransparency="true" seamless="seamless" scrolling="no" id="top-fundraisers"></iframe>
<?php } ?>
<script type="text/javascript">

var showFollowBarUI_params=
{ 
	containerID: 'FollowBarDiv',
	iconSize: 32,
	buttons: [
	{ 
		provider: 'facebook',
		actionURL: '<?php if (get_post_meta($post->ID, 'fb_url', $single = true)) { echo get_post_meta($post->ID, 'fb_url', $single = true); } else { echo 'https://www.facebook.com/braintumors'; } ?>',
		action: 'dialog',
                iconURL: 'http://www.braintumorcommunity.org/wrapper/FacebookIcon_32x32.png?=v2'
	},
	{ 
		provider: 'twitter',
		action: 'dialog',
		actionURL: 'https://twitter.com/NBTStweets',
		followUsers: 'NBTStweets',
                iconURL: 'http://www.braintumorcommunity.org/wrapper/TwitterIcon_32x32.png?=v2'
	},
	{ 
		provider: 'custom',
		actionURL: 'http://www.youtube.com/user/NBTSvideo',
		action: 'window',
		iconURL: 'http://www.braintumorcommunity.org/wrapper/YouTubeIcon_32x32.png?=v2'
	},
        { 
		provider: 'custom',
		actionURL: '<?php if (get_post_meta($post->ID, 'flickr_url', $single = true)) { echo get_post_meta($post->ID, 'flickr_url', $single = true); } else { echo 'http://www.flickr.com/photos/nbts/'; } ?>',
		action: 'window',
		iconURL: 'http://www.braintumorcommunity.org/wrapper/FlickrIcon_32x32.png?=v2'
	}
	]
}
</script>

<div id="FollowBarDiv" style="text-align: center; <?php if ('events' != get_post_type()) { ?>margin-top: 20px;<?php } ?>"></div>
<script type="text/javascript">
   gigya.socialize.showFollowBarUI(showFollowBarUI_params);
</script>
<?php
if ( is_active_sidebar('primary-widget-area') ) : ?>
<div id="primary" class="widget-area">
	<p>This is the sidebar.</p>
<ul class="sid">
<?php dynamic_sidebar('primary-widget-area'); ?>
</ul>
</div>
<?php endif; ?>
</aside>
</div>
</div>