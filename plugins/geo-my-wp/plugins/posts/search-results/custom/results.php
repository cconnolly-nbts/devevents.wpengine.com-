<?php
/**
 * Custom - Results Page.
 * @version 1.0
 * @author Eyal Fitoussi
 */
?>

	 <div id="titleBar"><div class="titleContainer"><div class="spacer">
	 	<h2><?php gmw_pt_within( $gmw, $sm=__( 'Showing', 'GMW' ), $om=__( 'out of', 'GMW' ), $rm=__( 'results', 'GMW' ) ,$wm=__( 'within', 'GMW' ), $fm=__( 'from','GMW' ), $nm=__( 'your location', 'GMW' ) ); ?></h2>
	</div></div></div>

	<div class="spacer">
		<article id="content">

<!--  Main results wrapper - wraps the paginations, map and results -->
<div class="gmw-results-wrapper gmw-results-wrapper-<?php echo $gmw['ID']; ?> gmw-pt-results-wrapper">
	
	<?php do_action( 'gmw_search_results_start' , $gmw, $post ); ?>
	
	<!-- results count
	<div class="gmw-results-count">
		<span><?php gmw_pt_within( $gmw, $sm=__( 'Showing', 'GMW' ), $om=__( 'out of', 'GMW' ), $rm=__( 'results', 'GMW' ) ,$wm=__( 'within', 'GMW' ), $fm=__( 'from','GMW' ), $nm=__( 'your location', 'GMW' ) ); ?></span>
	</div>
	 -->


	
	<?php do_action( 'gmw_before_top_pagination' , $gmw, $post ); ?>
	
		
	<!-- Map -->
	<?php gmw_results_map( $gmw ); ?>
	
	<div class="clear"></div>
	
	<?php do_action( 'gmw_search_results_before_loop' , $gmw, $post ); ?>
	
		
		<!--  this is where wp_query loop begins -->
		<?php while ( $gmw_query->have_posts() ) : $gmw_query->the_post(); ?>
			
			<!--  single results wrapper  -->
			<div id="post-<?php the_ID(); ?>" <?php post_class('wppl-single-result'); ?>>			
				<?php do_action( 'gmw_posts_loop_post_start' , $gmw, $post ); ?>

	<!--  Results wrapper -->
<div class="result">
	<div class="spacer pure-g-r">
		<div class="pure-u-2-3">					
				<!-- Title -->

				<h3>
					<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				
				<?php do_action( 'gmw_posts_loop_after_title' , $gmw, $post ); ?>
				
				<div>
					<?php gmw_pt_thumbnail( $gmw, $post ); ?>
				</div>
			
				<!--  Excerpt -->
    			<div>
				 	<?php gmw_pt_excerpt( $gmw, $post ); ?> 
				</div>
				
				<?php do_action( 'gmw_posts_loop_after_content' , $gmw, $post ); ?>
				
				<!--  taxonomies -->
				<div>
					<?php gmw_pt_taxonomies( $gmw, $post ); ?>
				</div>
				
		    	<div class="clear"></div>
		    	
		    	
	    		
	    			<!--  Address -->
	    			<div class="wppl-address">
	    				<p><?php echo $post->address; ?></p>
	    			</div>

	    			<!--  Addiotional info -->
					<div>	
	    				<p><?php gmw_pt_additional_info( $gmw, $post, $tag='div' ); ?></p>
	    			</div>
	    				    		
	    			<!--  Driving Distance -->
	    			<p><?php gmw_pt_driving_distance( $gmw, $post, $class='wppl-driving-distance', $title=__( 'Distance: ', 'GMW' ) ); ?></p>
	    			
	    			<!-- Get directions -->	 	
    				<div>
		    			<p><?php gmw_pt_directions( $gmw, $post, $title=__( 'Get Directions', 'GMW' ) ); ?></p>
	    			</div>
		    	</div> <!-- info -->
		    	
		    	<?php do_action( 'gmw_posts_loop_post_end' , $gmw, $post ); ?>

  	  
<?php $event_status = get_post_meta($post->ID, 'event_status', $single = true);
if ( $event_status == 'past' ) {?>
	<div class="pure-u-1-3">
	    <p class='donateLink'><a class='pure-button' href='<?php echo get_post_meta( get_the_ID(), 'donate_url', true ); ?>'>Donate to this event</a></p>
    </div>
<?php
}
else {?> 
	<div class="pure-u-1-3">
	    <p class='donateLink'><a class='pure-button' href='<?php echo get_post_meta( get_the_ID(), 'donate_url', true ); ?>'>Donate to this event</a></p>
	    <p class='registerInivLink'><a class='pure-button' href='<?php echo get_post_meta( get_the_ID(), 'register_url', true ); ?>'>Register as an individual</a></p>
	    <p class='joinLink'><a class='pure-button' href='<?php echo get_post_meta( get_the_ID(), 'join_team_url', true ); ?>'>Join a team</a></p>
	    <p class='registerTeamLink'><a class='pure-button' href='<?php echo get_post_meta( get_the_ID(), 'register_url', true ); ?>'>Register a new team</a></p>
	    <a class='pure-button event-register-team-button' href='<?php echo get_post_meta( get_the_ID(), 'volunteer_url', true ); ?>'>Sign Up to Volunteer</a></p>
    </div>
 <?php  }?>

   </div> 
</div> 
	<!--  results wrapper -->    		    	
		
		<!--  single- wrapper ends -->
		    
		    <div class="clear"></div>     
	
		<?php endwhile; ?>
		<!--  end of the loop -->
	
	<?php do_action( 'gmw_search_results_after_loop' , $gmw, $post ); ?>
	
</div> <!-- output wrapper -->
