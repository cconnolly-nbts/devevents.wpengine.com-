<div class="clear"></div>
</div>
<footer>
<a name="menu"></a>
<div id="footContain">
<div class="spacer">

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




echo '<div class="footer-buttons">';
if(!is_front_page() ) { 
if ('events' == get_post_type()) { ?>


<?php } ?>

<?php } ?>

</div>
<div id="footComponentDiv"></div>
<ul id="footerMenu">
  <li><a href="http://events.braintumor.org/join-the-fight/" target="_self">Join the Fight</a></li>
  <li><a href="http://events.braintumor.org/participant-tools/" target="_self">Participant Tools</a></li>
  <li><a href="http://events.braintumor.org/dollars-in-action/" target="_self">Dollars in Action</a></li>
  <li><a href="/contact-us/" target="_self">Contact Us</a></li>
  <li><a href="/frequently-asked-questions/" target="_self">FAQ</a></li>
  <li class="box"><a href="/participant-stories/" target="_self">Participant Stories</a></li>
  <li class="box"><a href="/our-partners/" target="_self">Our Partners</a></li>
  <li class="box"><a href="/community-events/" target="_self">Community Events</a></li>
  <li><a href="http://events.braintumor.org/tr-search-results/" target="_self">Donate</a></li>
  <?php if(!is_front_page() ) { ?><li><a href="http://events.braintumor.org/">Back to Main Events Page</a></li><?php } ?>
</ul>

</div>
</div>
</footer>
</div>
<?php wp_footer(); ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-42780151-1', 'braintumor.org');
ga('send', 'pageview');
</script>


<?php if ('events' == get_post_type()) { ?>

<?php } ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/validatious-custom-0.9.1.min.js"></script>
<script>
  $.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}
  if($.urlParam('message')) {
    var message = $.urlParam('message').replace(/\+/g, ' ');
    alert(decodeURIComponent(message));
  }
</script>  
<script type="text/javascript">
var $container = $('#isotopeContainer');
$container.isotope({
  // options
  itemSelector : '.isotopeItem',
  layoutMode : 'fitRows'
});

var $container2 = $('#isotopeContainer2');
$container2.isotope({
  // options
  itemSelector : '.isotopeItem2',
  layoutMode : 'fitRows'
});

$('#filters').change(function(){
  var selector = $(this).find(":selected").attr('data-filter');
  $container.isotope({ filter: selector });
  $container2.isotope({ filter: selector });
  return false;
});

$(document).ready(function(){
   //filter on load
   setTimeout(function(){$container.isotope({ filter: '*' });},500);
  
})
</script>

<script type="text/javascript">
adroll_adv_id = "JICLWH3PKRFL7JU4GHZBTW";
adroll_pix_id = "GQLYBWCC25D6NHVOYTTQD2";
(function () {
var oldonload = window.onload;
window.onload = function(){
   __adroll_loaded=true;
   var scr = document.createElement("script");
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
   scr.setAttribute('async', 'true');
   scr.type = "text/javascript";
   scr.src = host + "/j/roundtrip.js";
   ((document.getElementsByTagName('head') || [null])[0] ||
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
   if(oldonload){oldonload()}};
}());
</script>
</body>
</html>