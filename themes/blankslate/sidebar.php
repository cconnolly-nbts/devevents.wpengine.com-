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
$df_id = get_post_meta($post->post_parent, 'df_id', $single = true);
$sponsor_level = get_post_meta($post->post_parent, 'sponsor_level', $single = true);
$event_status = get_post_meta($post->post_parent, 'event_status', $single = true);
$event_id = get_post_meta($post->post_parent, 'event_id', $single = true);
$participants_status_id = get_post_meta($post->post_parent, 'participants_status_id', $single = true);
$team_status_id = get_post_meta($post->post_parent, 'team_status_id', $single = true);
$find_id = get_post_meta($post->post_parent, 'find_id', $single = true);
$honor_roll = get_post_meta($post->post_parent, 'honor_roll', $single = true);

$event_association = wp_get_post_terms( $post->post_parent, 'event_association');
} else {
$fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
$fr_name = get_post_meta($post->ID, 'fr_name', $single = true);
$event_type = get_post_meta($post->ID, 'event_type', $single = true);
$date_long= get_post_meta($post->ID, 'date_long', true);
$df_id = get_post_meta($post->ID, 'df_id', true);
$sponsor_level = get_post_meta($post->ID, 'sponsor_level', true);
$event_status = get_post_meta($post->ID, 'event_status', true);
$event_id = get_post_meta($post->ID, 'event_id', true);
$participants_status_id = get_post_meta($post->ID, 'participants_status_id', true);
$team_status_id = get_post_meta($post->ID, 'team_status_id', true);
$find_id = get_post_meta($post->ID, 'find_id', true);
$honor_roll = get_post_meta($post->ID, 'honor_roll', true);

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
$status = $tr_xml->teamraiser->status;

$params2 = array('fr_id' => 2220);
$response2 = $convioAPI->call('CRTeamraiserAPI_getTopTeamsData', $params2);
$tr_xml2 = simplexml_load_string($response2);
$top_teams = $tr_xml2->teamraiserData->name;
$team_amount = $tr_xml2->teamraiserData->total;

echo '<div class="sidebar-buttons">';

if ('events' == get_post_type()) { ?>
<?php 
if (($registrations && $registrations == 'false') || ('events' == get_post_type() && $registrations == '')){} else { ?><a class="registerButton pure-button" href="http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?>"><strong>REGISTER</strong><?php if ($event_type) { echo ' TO ' . $event_type; } ?></a><?php } ?>
<?php } ?>

<?php 
if (($fr_id == 'kimbia')){ ?>
<a class="registerButton pure-button" style="background-color:#7BC143;" href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/registration/"><strong>REGISTER</strong> TO WALK</a>
<a class="donateButton pure-button" style="background-color:#F47B29;" href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/find-a-particpant/"><strong>DONATE</strong> TO A PARTICIPANT</a>
<a class="signupButton pure-button" href="http://events.braintumor.org/events/<?php global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/registration/"><strong>SIGN UP</strong> TO VOLUNTEER</a>

<?php } ?>

<?php 
if (($fr_id == 'artez')){ ?>
<a class="registerButton pure-button" style="background-color:#7BC143;" href="https://secure.e2rm.com/registrant/LoginRegister.aspx?eventid=<?php echo $event_id; ?>&action=register"><strong>REGISTER</strong> TO RACE</a>
<a class="donateButton pure-button" style="background-color:#F47B29;" href="https://secure.e2rm.com/registrant/startup.aspx?eventid=<?php echo $event_id; ?>&getpage=tabbedIndividualSearch"><strong>DONATE</strong> TO A PARTICIPANT</a>
<?php } ?>


<?php if (($donations && $donations == 'false') || ('events' == get_post_type() && $donations == '')){} 
else { ?><a class="<?php if (('events' == get_post_type()) && ($status != '3' )) { ?>donateButton<?php } 
else { ?>registerButton<?php } ?> pure-button" href="<?php if ('events' == get_post_type() && $status != '3' || $event_status == 'past') { ?>http://www.braintumorcommunity.org/site/TR/Events/?fr_id=<?php echo $fr_id; ?>&pg=pfind<?php } 
elseif ('events' == get_post_type() && ( $status == '3' && $df_id && $df_id != '')) { ?>https://secure2.convio.net/bts/site/Donation2?idb=1287902295&df_id=<?php echo $df_id; ?>&FR_ID=<?php echo $fr_id; ?>&<?php echo $df_id; ?>.donation=form1&PROXY_ID=<?php echo $fr_id; ?>&PROXY_TYPE=21<?php }
else { ?>/donate/<?php } ?>"><strong>DONATE</strong><?php if (('events' == get_post_type())  && ( $status != '3' ))  { echo ' TO A PARTICIPANT';} ?></a><?php } ?>

<?php 
if (($fr_id == 'artez')){ ?>

<a class="signupButton pure-button" href="https://secure.e2rm.com/registrant/LoginRegister.aspx?eventid=<?php echo $event_id; ?>&action=register"><strong>SIGN UP</strong> TO VOLUNTEER</a>
<?php } ?>




<?php if (($registrations && $registrations == 'false') || ('events' == get_post_type() && $registrations == '')){} else { ?><a class="signupButton pure-button" href="<?php if ('events' == get_post_type()) { ?>http://www.braintumorcommunity.org/site/TRR/Events/?pg=tfind&fr_id=<?php echo $fr_id; ?><?php } else { ?>/volunteer-information/<?php } ?>"><strong>SIGN UP</strong> TO VOLUNTEER</a><?php } ?>
<a class="becomeButton pure-button" href="/become-a-sponsor/"><strong>BECOME</strong> A SPONSOR</a> 
</div>


<?php 
if ('events' == get_post_type() )  {
  if (($sponsor_count != 0 ) || ($fr_id == 'kimbia' ) || ($fr_id == 'artez' )) {
  //if ($sponsor_level != 'bronze') {
  echo '<h3 class="sponsorTitle">Thank you to our sponsors & <br/>media partners</h3><div class="sponsorSlide">';


// LOOP FOR SPONSORS LIST
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

// LOOP FOR BRONZE SPONSORS LIST
$loop3 = new WP_Query( 'post_type=bronze_sponsors&orderby=title&order=asc&event_association=' . $slug );
  while ( $loop3->have_posts() ) : $loop3->the_post();
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

// LOOP FOR MEDIA PARTNERS LIST
$loop2 = new WP_Query( 'post_type=media_partners&orderby=title&order=asc&event_association=' . $slug );
  while ( $loop2->have_posts() ) : $loop2->the_post();
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
// END LOOP

// LOOP FOR MEDIA PARTNERS LIST
$loop4 = new WP_Query( 'post_type=partners&orderby=title&order=asc&event_association=' . $slug );
  while ( $loop4->have_posts() ) : $loop4->the_post();
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
// END LOOP

  echo '</div>';
  }
} else{
  echo '<h3 class="sponsorTitle">Thank you to our sponsors</h3><div class="sponsorSlide">';
  $args = array( 
  'post_type' => array('sponsors', 'bronze_sponsors', 'media_partners'),
  'orderby' => 'title',
  'order' => 'ASC'
);
    /*'meta_query' => array(
        array(
            'key' => 'sponsor_level',
            'value' => 'gold',
            'compare' => 'LIKE'
        )
    )
    );*/
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();
    echo '<div class="sliderItem">';
    if (get_post_meta($post->ID, 'sponsor_url', $single = true)){
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


<?php 
if (($fr_id == 'kimbia')){ ?>
<h3 style="font-size: 1.17em; color:#00A0DF; margin:20px 0px;">TOP FUNDRAISERS</h3>
<div class="widget">
<!-- Team Status -->
<script src='https://widgets.kimbia.com/widgets/fundraisingTeam.js?id=<?php echo $team_status_id; ?>'></script>
</div>

<div class="widget" style="margin-bottom:30px;">
<a href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/top-teams/">VIEW ALL TEAMS</a>
</div>

<div class="widget">
  <script src='https://widgets.kimbia.com/widgets/status.js?id=<?php echo $participants_status_id; ?>'></script>
</div>

<div class="widget" style="margin-bottom:50px;">
<a href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/top-participant">VIEW ALL PARTICIPANTS</a>
</div>

<div class="widget">
  <script src='https://widgets.kimbia.com/widgets/status.js?id=<?php echo $honor_roll; ?>'></script>
</div>

<?php } ?>


<?php 
$file = file_get_contents('http://my.e2rm.com/webgetservice/get.asmx/getTeamScoreBoard?eventID='.$event_id.'&languageCode=en-CA&sortBy=onlineAmount&listItemCount=100&externalQuestionID=&externalAnswerID=&Source='); //change this to whichever feed you wish to use
$teamxml = simplexml_load_string($file);
foreach($teamxml->TeamScoreBoard_collection->TeamScoreBoard as $b){ //This loops around each event

$sortKeyPrimary = $b->sortKeyPrimary;
}
if (($fr_id == 'artez' && $sortKeyPrimary == true)){ ?>
<h3 style="font-size: 1.17em; color:#00A0DF; margin:20px 0px 0px 0px;">TOP FUNDRAISERS</h3>
<!-- <iframe style="padding: 0;"  src="http://my.e2rm.com/api/scoreboard.aspx?eventid=<?php echo $event_id; ?>&locationid=148006&scoreboardtype=team" frameborder="0" allowtransparency="true" seamless="seamless" scrolling="no" id="top-fundraisers" class="ie-frame"></iframe> -->
<h2 style="font-size: 1.17em; color:#000; margin:20px 0px 0px 0px;">Top Teams</h2>
<?php 

          $persoanl = file_get_contents('http://my.e2rm.com/webgetservice/get.asmx/getParticipantScoreBoard?eventID=<?php echo $event_id; ?>&languageCode=en-CA&sortBy=onlineAmount&listItemCount=100&externalQuestionID=&externalAnswerID=&Source='); //change this to whichever feed you wish to use
          $xml = simplexml_load_string($personal);
          foreach($xml->ParticipantScoreBoard_collection->ParticipantScoreBoard as $x){ //This loops around each event

          //Get the event details
          $firstname = $x->ParticipantFirstName;
          $lastname = $x->ParticipantLastName;
          $ScoreboardDisplayName = $x->ScoreboardDisplayName;
          $onlineTotalCollected = $x->onlineTotalCollected;
          $ScoreboardCount = $x->ScoreboardCount;
          $RegistrationID = $x->RegistrationID;
          $ParentEventID = $x->ParentEventID;
        }

        //XML CODE STARTS HERE
          
          $file = file_get_contents('http://my.e2rm.com/webgetservice/get.asmx/getTeamScoreBoard?eventID='.$event_id.'&languageCode=en-CA&sortBy=onlineAmount&listItemCount=100&externalQuestionID=&externalAnswerID=&Source='); //change this to whichever feed you wish to use
          $teamxml = simplexml_load_string($file);
          foreach($teamxml->TeamScoreBoard_collection->TeamScoreBoard as $a){ //This loops around each event

          //Get the event details
          $OnlineTotalCollected = $a->OnlineTotalCollected;
          $TeamName = $a->TeamName;
          $TeamID = $a->TeamID;
          $sortKeyPrimary = $a->sortKeyPrimary;
          $dollarCalc=$sortKeyPrimary*1;
          setlocale(LC_MONETARY, 'en_US');


          echo '<p><b><a href=" https://secure.e2rm.com/registrant/TeamFundraisingPage.aspx?EventID='.$event_id.'&LangPref=en-CA&TeamID='.$TeamID.'">'.$TeamName . "</a></b> (" . money_format('%.2n', $dollarCalc) .")</p>" ; 


           }
?>
<p style="font-size: 15px !important; padding-bottom:15px;">
<a href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/team-list/">View all teams</a>
</p>

<!--<iframe style="padding:0;"  src="http://my.e2rm.com/api/scoreboard.aspx?eventid=148005&locationid=148006&scoreboardtype=ind" frameborder="0" allowtransparency="true" seamless="seamless" scrolling="no" id="top-fundraisers" class="ie-frame"></iframe> -->
<h2 style="font-size: 1.17em; color:#000; margin:20px 0px 0px 0px;">Top Participants</h2>
<?php
          $file = file_get_contents('http://my.e2rm.com/webgetservice/get.asmx/getParticipantScoreBoard?eventID='.$event_id.'&languageCode=en-CA&sortBy=onlineAmount&listItemCount=100&externalQuestionID=&externalAnswerID=&Source='); //change this to whichever feed you wish to use
          $xml = simplexml_load_string($file);
          foreach($xml->ParticipantScoreBoard_collection->ParticipantScoreBoard as $x){ //This loops around each event

          //Get the event details
          $firstname = $x->ParticipantFirstName;
          $lastname = $x->ParticipantLastName;
          $ScoreboardDisplayName = $x->ScoreboardDisplayName;
          $onlineTotalCollected = $x->onlineTotalCollected;
          $ScoreboardCount = $x->ScoreboardCount;
          $RegistrationID = $x->RegistrationID;
          $ParentEventID = $x->ParentEventID;
          $dollarCalc=$onlineTotalCollected*1;
          setlocale(LC_MONETARY, 'en_US');


          echo '<p><b><a href="https://secure.e2rm.com/registrant/FundraisingPage.aspx?EventID='.$ParentEventID.'&LangPref=en-CA&RegistrationID='.$RegistrationID.'">'.$firstname . " " . $lastname ."</a></b> (" . money_format('%.2n', $dollarCalc).")</p>" ;
          
           }
?>
<p style="font-size: 15px !important; padding-bottom:15px;">
<a href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/top-participants/">View all participants</a>
</p>
<?php } 

?>


<?php if (('events' == get_post_type())  && ( $status != '3' || $event_status == 'past') && (!$post->post_parent && $fr_id != 'kimbia') && (!$post->post_parent && $fr_id != 'artez')) { ?>
<iframe style="padding: 20px 0;"  src="http://www.braintumorcommunity.org/site/PageServer?pagename=pbAPITopFundraisers&s_frid=<?php echo $fr_id; ?>" frameborder="0" allowtransparency="true" seamless="seamless" scrolling="no" id="top-fundraisers" class="ie-frame"></iframe>
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