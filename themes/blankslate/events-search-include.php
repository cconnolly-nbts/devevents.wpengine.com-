<div class="pure-g-r <?php if(is_front_page() ) { echo 'home-search'; } ?>">

<div class="eventSearch pure-u-2-5">
	<div class="eventSearchSpacing">
	<div class="searchStyle">
	<div class="spacer">
  <h3>SIGN UP OR FIND AN EVENT</h3>
  <form method="post" action="/tr-search-results/" class="pure-form pure-form-stacked validate" id="events-search">
    <fieldset>
      <input type="text" id="tr_info" class="required min-length_3 pure-input-1" value="" name="tr_info" placeholder="Zip code or event name" title="A zip code or event name of at least 3 characters is required." />
      <button type="submit" class="pure-button" name="tr_info_search_submit">Search</button>
    </fieldset>
  </form>
  <p></p><a href="/events-list/">VIEW ALL EVENTS</a></p>

<p><hr></p>
<h3>TEST GEO LOCATION SEARCH</h3>
<?php echo do_shortcode('[gmw form="1"]'); ?>
  </div>
  </div>
  </div>
  </div>

<div class="participantSearch pure-u-3-5">
	<div class="participantSearchSpacing">
	<div class="searchStyle">
	<div class="spacer">
  <h3>DONATE TO PARTICIPANT OR TEAM</h3>
  <form method="post" action="/tr-search-results/" class="pure-form validate" id="participant-search">
  	<fieldset class="validate_any required min-length_3" title="Please fill out any of the form fields with at least 3 characters.">
    <input class="pure-input-1-3" type="text" name="first_name" placeholder="First Name" />
    <input class="pure-input-1-3" type="text" name="last_name" placeholder="Last Name" />
    <p>&nbsp;OR</p>
    <input class="pure-input-1" type="text" name="team_name" placeholder="Team Name" />
    </fieldset>
    <button type="submit" class="pure-button" name="participant_search_submit">Search</button>
  </form>
  </div>
  </div>
  </div>
 </div>
  
</div>