<!-- SINGLE EVENTS.PHP -->

<?php 
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
  $event_location = get_post_meta($post->post_parent, 'event_location', $single = true);
  $date_long = get_post_meta($post->post_parent, 'date_long', $single = true);
  $event_id = get_post_meta($post->post_parent, 'event_id', $single = true);
} else {
  $fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
  $fr_name = get_post_meta($post->ID, 'fr_name', $single = true);
  $event_type = get_post_meta($post->ID, 'event_type', $single = true);
  $date_long= get_post_meta($post->ID, 'date_long', true);
  $fb_url = get_post_meta($post->ID, 'fb_url', $single = true);
  $event_location = get_post_meta($post->ID, 'event_location', $single = true);
  $event_id = get_post_meta($post->ID, 'event_id', $single = true);
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
    if ($fr_id == 'artez' || $fr_id == 'kimbia'){
      echo '<p class="eventInfo">'. $date_long . ', ' . $event_location . '</p>';
    } 
    else {
    if ($event_date != 'Thursday, January 1, 1970' or ($location_name && $location_name != '') or ($event_city && $event_city != '') or ($event_state && $event_state != '')) {
      echo '<p class="eventInfo">';
      if ($event_date != 'Thursday, January 1, 1970') {
        echo $event_date;
      }
      if (($location_name && $location_name != '') or ($event_city && $event_city != '') or ($event_state && $event_state != '')) {
        if ($event_date != 'Thursday, January 1, 1970') {
          echo ', ';
        }
        if ($location_name && $location_name != '') {
          echo $location_name;
          if (($event_city && $event_city != '') or ($event_state && $event_state != '')) {
            echo ', ';
          };
        };
        if ($event_city && ($event_city != '')) {
          echo $event_city;
          if ($event_state) {
            echo ', ' . $event_state;
          };
        };  
      };
      echo '</p>';
    } else {
      echo '<p class="eventInfo">Event date and location coming soon</p>';
    }
  }
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
        
      <!-- mobile buttons -->
        <?php 
        echo '<div class="footer-buttons">';
        if(!is_front_page() ) { 

		if (($fr_id == 'artez')){ ?>
        <a class="registerButton pure-button" style="background-color:#7BC143;" href="https://secure.e2rm.com/registrant/LoginRegister.aspx?eventid=<?php echo $event_id; ?>&action=register"><strong>REGISTER</strong></a>
        <a class="donateButton pure-button" style="background-color:#F47B29;" href="https://secure.e2rm.com/registrant/mobile/MobileDonate.aspx?eventid=<?php echo $event_id; ?>"><strong>DONATE</strong></a>
        <a class="signupButton pure-button" href="https://secure.e2rm.com/registrant/LoginRegister.aspx?eventid=<?php echo $event_id; ?>&action=register"><strong>SIGN UP</strong> TO VOLUNTEER</a>
        <?php } 
        elseif (($fr_id == 'kimbia')){ ?>
		<a class="registerButton pure-button" style="background-color:#7BC143;" href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/registration/"><strong>REGISTER</strong> TO WALK</a>
		<a class="donateButton pure-button" style="background-color:#F47B29;" href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/find-a-particpant/"><strong>DONATE</strong> TO A PARTICIPANT</a>
		<a class="signupButton pure-button" href="http://events.braintumor.org/events/<?php global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/registration/"><strong>SIGN UP</strong> TO VOLUNTEER</a>
		<?php } else { ?>

        <?php 
        if ('events' == get_post_type()) { ?>
        
        <?php if ($registrations && $registrations == 'false' || $fr_id == 'kimbia'){} else { ?><a class="registerButton pure-button" href="http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?>"><strong>REGISTER</strong><?php if ($event_type) { echo ' TO ' . $event_type; } ?></a><?php } ?>
        <?php } ?>
        <?php if ($donations && $donations == 'false' || $fr_id == 'kimbia' ){} else { ?><a class="<?php if ('events' == get_post_type()) { ?>donateButton<?php } else { ?>registerButton<?php } ?> pure-button" href="<?php if ('events' == get_post_type()) { ?>http://www.braintumorcommunity.org/site/TR/Events/?fr_id=<?php echo $fr_id; ?>&pg=pfind<?php } else { ?>/tr-search-results/<?php } ?>"><strong>DONATE</strong><?php if ('events' == get_post_type()) { echo ' TO A PARTICIPANT';} ?></a><?php } ?>
        <?php if ($registrations && $registrations == 'false'  || $fr_id == 'kimbia'){} else { ?><a class="signupButton pure-button" href="<?php if ('events' == get_post_type()) { ?>http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?><?php } else { ?>/volunteer-information/<?php } ?>"><strong>SIGN UP</strong> TO VOLUNTEER</a><?php } ?>
        <?php } }?>
        <a class="becomeButton pure-button" href="/become-a-sponsor/"><strong>BECOME</strong> A SPONSOR</a>
        </div>
      <!-- mobile buttons -->

      <?php 
      if (($fr_id == 'artez')){ 
      //XML CODE STARTS HERE

      $file = file_get_contents('http://my.e2rm.com/webgetservice/get.asmx/getEventFundraisingTotals?eventID='. $event_id .'&loginOrgID=nbts&locationExportID=&Source='); //change this to whichever feed you wish to use
      $xml = simplexml_load_string($file);
      foreach($xml->eventFundraisingTotals_collection->eventFundraisingTotals as $x){ //This loops around each event

      //Get the event details
      $eventVerifiedTotalCollected = $x->eventVerifiedTotalCollected;
      $eventVerifiedFundraisingGoal = $x->eventVerifiedFundraisingGoal;
      $eventid = $x->eventid;
      $onlineTotalCollected = $x->onlineTotalCollected;
      $dollarCalc=$eventVerifiedTotalCollected*1;
      setlocale(LC_MONETARY, 'en_US');

      echo '<p style="color:#66BC29; font-family: Arial, Helvetica, Sans-Serif; font-size:20px;">Amount Raised: ' . money_format('%.2n', $dollarCalc) ."</p>" ;
       }
        ?> 
      <?php } ?>

        <?php if ((!$post->post_parent && $fr_id != 'artez') && (!$post->post_parent && $fr_id != 'kimbia')) { ?><iframe class="amountFrame" style="width: 100%; height: 50px;" src="http://www.braintumorcommunity.org/site/PageServer?pagename=pbAPI&s_frid=<?php echo $fr_id; ?>" frameborder="0" allowtransparency="true" seamless="seamless" scrolling="no" id="amount-raised"></iframe><?php } ?>
        <?php the_content(); ?> 
        <?php if ($fb_url && !$post->post_parent) { ?><div class="fb-like-box" data-href="<?php echo $fb_url; ?>" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div><?php } ?>
      <?php endwhile; endif; ?>

    </div></div>

<?php 
if (($fr_id != 'stayclassy')){ ?>
    <?php get_sidebar(); ?>
<?php } ?>
  </div>
  <?php get_footer(); ?>