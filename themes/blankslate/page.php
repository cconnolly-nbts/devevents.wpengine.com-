<?php get_header(); ?>
<?php the_post(); ?>
<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2><?php the_title(); ?></h2>
</div></div></div>


<div id="content" class="pure-g-r">
<div class="pure-u-2-3">

<div class="spacer">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">

<div id="event_url" style="display:none"></div>

<?php the_content(); ?>
</div>
</div>
<?php comments_template( '', true ); ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>
<script>
 if ($.cookie('event_cookie')){
	$('#event_url').show();
	$('#event_url').html('<a href="'+$.cookie('event_cookie')+'">Back to event</a>');
};
</script>
<?php get_footer(); ?>