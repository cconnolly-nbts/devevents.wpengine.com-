<!DOCTYPE html>
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
$event_id = get_post_meta($post->post_parent, 'event_id', $single = true);
} else {
$fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
$fr_name = get_post_meta($post->ID, 'fr_name', $single = true);
$event_type = get_post_meta($post->ID, 'event_type', $single = true);
$event_association = wp_get_post_terms( $post->ID, 'event_association');
$event_id = get_post_meta($post->ID, 'event_id', $single = true);
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
?>

<html <?php language_attributes(); ?>>
<head>
<link rel="shortcut icon" href="http://blog.braintumor.org/favicon.ico?v=2" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(' | ', true, 'right'); ?></title>


 <!--[if lt IE 10]>
    <script src="http://events.braintumor.org/wp-content/themes/blankslate/js/html5shiv-printshiv.js"></script>
 <![endif]-->

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css" />

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
 <!--[if lt IE 10]>
<link rel="stylesheet" type="text/css" href="http://events.braintumor.org/wp-content/themes/blankslate/all-ie-only.css" />
 <![endif]-->


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.gigya.com/js/socialize.js?apiKey=2_0rh_PIXKeng_rY4zI3RdUFGuQYvvCztwvAL85O8vhHLW2sC_7Gvh3zbzcgtYZmFo"></script>
<?php if ('events' == get_post_type()) { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/iframe.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/luminateExtend.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/phpDate.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/validate.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/luminateFunctions.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cycle.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/transition.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.sponsorSlide').cycle({
    fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
  });
  var slideCount = $('.sliderItem').length;
  if (slideCount == 0) {
    $('.sponsorTitle').hide();
  }
  
});

  var pcLink = '';
</script>

<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = '//www.bugherd.com/sidebarv2.js?apikey=6bjvcxzmnchzfd7e1jtxfq';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script> 

<?php if ('events' == get_post_type()) { ?>
<script>
  ;(function($){         
      $(function(){
        $('#top-fundraisers').responsiveIframe({ xdomain: '*'});
      });       
  })(jQuery);

  var pcUrl = 'http://www.braintumorcommunity.org/site/TRC/Events/?fr_id=<?php echo $fr_id; ?>&pg=center';
  var eventTitle = '<?php echo $fr_name; ?>';
  pcLink = '<br /><a href="' + pcUrl + '">' + eventTitle + ' Participant Center</a>';
</script>
<?php } ?>
<?php wp_head(); ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#events-search").validate();
});
</script>
<script type="text/javascript">
var act = new gigya.socialize.UserAction();
act.setLinkBack("<?php the_permalink() ?>");
var showShareBarUI_params=
{ 
  containerID: 'componentDiv',
  shareButtons: 'Facebook-Like,Share',
  userAction: act
}
gigya.socialize.showShareBarUI(showShareBarUI_params);

var act = new gigya.socialize.UserAction();
act.setLinkBack("<?php the_permalink() ?>");
var showFootShareBarUI_params=
{ 
  containerID: 'footComponentDiv',
  shareButtons: 'Facebook-Like,Share',
  userAction: act
}
gigya.socialize.showShareBarUI(showFootShareBarUI_params);
</script>


</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=131467953554543";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper" class="hfeed">
<div id="mobileLogin"></div>
<header>
<div id="siteHeader" class="cf">

<?php 
if (($fr_id != 'kimbia') && ($fr_id != 'artez')){ ?>
<div class="login-help">Login to your Participant center here:</div>
<div class="login-social" style="float: right; padding: 5px 10px 0 0;">
<div id="componentDiv" style="float: left;"></div>
<form method="post" id="login-form" class="pure-form login-top" action="https://secure2.convio.net/bts/site/CRConsAPI">
<input type="hidden" name="api_key" id="api_key" value="thooG9Ke" />
<input type="hidden" name="v" id="v" value="1.0" />
<input type="hidden" name="method" id="method" value="login" />
<input type="hidden" name="success_redirect" value="<?php the_permalink() ?>?cons_id=${loginResponse/cons_id}" >
<input type="hidden" name="error_redirect" value="<?php the_permalink() ?>?code=${errorResponse/code}&message=${errorResponse/message}" >
<input type="hidden" name="sign_redirects" id="sign_redirects" value="true" />
<input name="user_name" placeholder="Username" title="Please enter your username to login." type="text" size="10" maxlength="100">
<input name="password" placeholder="Password" title="Please enter your password to login." type="password" size="10" maxlength="100">
<button type="submit" class="pure-button registerButton" style="color: #fff;">Login</button><br />
<p><a href="http://www.braintumorcommunity.org/site/UserLogin?NEXTURL=<?php the_permalink(); ?>">Forgot username or password?</a></p>
</form>
</div>

<?php } 
if (($fr_id == 'kimbia')){ ?>
  <div class="login-social" style="float: right; padding: 5px 10px 0 0;"><a class="pure-button registerButton" style="color: #fff !important;" href="http://events.braintumor.org/events/<?php  global $post; if($post->post_parent) { $post_data = get_post($post->post_parent); echo $post_data->post_name; } else {echo $post->post_name;}?>/manage">Visit Your Personal Page</a></div>
<?php } ?>

<?php  
if (($fr_id == 'artez')){ ?>
<div class="login-help">Login to your Personal Page here:</div>
<div class="login-social" style="float: right; padding: 5px 10px 0 0;">
<form method="post" class="pure-form login-top" action="https://secure.e2rm.com/registrant/LoginRegister.aspx?eventid=148005">
    <input name="txtUserID" placeholder="Username" title="Please enter your username to login." type="text" size="10" maxlength="100">
    <input name="txtPassword" placeholder="Password" title="Please enter your password to login." type="password" size="10" maxlength="100">
    <button type="submit" class="pure-button registerButton" style="color: #fff;" value="Log In">Login</button>
    <p><a href="https://secure.e2rm.com/registrant/ForgetPassword.aspx?eventid=148005">Forgot username or password?</a></p>
</form>
  </div>
<?php } ?>

<h1 class="headerLogo"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="National Brain Tumor Society Events" /></a></h1>
<?php wp_nav_menu( array( 'theme_location' => 'primary-nav' ) ); ?>
<div class="mobile-buttons">

<?php 
  if (($fr_id == 'artez')){ ?>
    <a class="pure-button header-login-button" href="https://secure.e2rm.com/registrant/mobile/mobileEventInfo.aspx?eventid=<?php echo $event_id; ?>&langpref=en-CA&Referrer=direct%2fnone">Login</a>
  <?php  } else {?>
    <a class="pure-button header-login-button" href="http://www.braintumorcommunity.org/site/UserLogin?NEXTURL=<?php the_permalink(); ?>">Login</a>
  <?php  } ?>
    <a class="pure-button header-menu-button" href="#menu">Menu</a>


</div>
</div>
</header>
<div id="container">