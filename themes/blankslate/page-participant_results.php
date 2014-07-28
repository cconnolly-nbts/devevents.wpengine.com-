<?php
/*
Template Name: Participant / Events / Teams Search Results
*/
get_header(); ?>

<!--
<script type="text/javascript">
$(document).ready(function(){
       if ($(".pure-u-2-3:contains('Dallas-Ft.')").length) {
          $('.pure-u-1-3').hide();
       }                                           
    })
$(document).ready(function(){
       if ($(".pure-u-2-3:contains('Long Island')").length) {
          $('.pure-u-1-3').hide();
       }                                           
    })
$(document).ready(function(){
       if ($(".pure-u-2-3:contains('Nashville')").length) {
          $('.pure-u-1-3').hide();
       }                                           
    })
</script>
-->

<?php if (isset($_POST['participant_search_submit'])) { ?>
<div id="titleBar"><div class="titleContainer"><div class="spacer">


<h2>Particpant or Team Search Results for "<?php if (isset ($_POST['first_name'])) { echo $_POST['first_name']; }; ?>
<?php if (isset ($_POST['last_name'])) { echo $_POST['last_name']; }; ?>
<?php if (isset ($_POST['team_name'])) { echo $_POST['team_name']; }; ?>"</h2>
</div>
</div>
</div>
<div class="spacer">
<article id="content">
<script>
var formFirstName="<?php echo $_POST['first_name']; ?>";
var formLastName="<?php echo $_POST['last_name']; ?>";
var formTeamName="<?php echo $_POST['team_name']; ?>";
</script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/participantSearch.js"></script>




<?php include 'results.php'; ?>



</article>
</div>
<?php } else if (isset($_POST['tr_info_search_submit'])) { $formsub=$_POST['tr_info']; ?>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2>Event Search Results for "<?php if (isset ($_POST['tr_info'])) { echo $_POST['tr_info']; }; ?>"</h2>
</div></div></div>
<div class="spacer">
<article id="content">
<script>
var formData=String("<?php echo $formsub ?>");
</script> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/eventSearch.js"></script>
</article>
</div>
<?php } else { ?>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2>Search for an Event, Team, or Participant</h2>
</div></div></div>
<div class="spacer">
<article id="content">	
<p>To volunteer or participate in an event, please search for that event in the box to the left. To donate to a participant or to find a team, please search using the box on the right.</p>
<?php include 'events-search-include.php'; ?>
</article>
</div>
<?php } ?>
<?php get_footer(); ?>