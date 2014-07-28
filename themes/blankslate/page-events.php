<?php
/*
Template Name: Events Landing Page
*/
get_header();
?>
<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>
<div id="titleBar"><div class="titleContainer"><div class="spacer"><h2 class="home">National Brain Tumor Society <span>WALKS, RIDES, and RACES</span></h2></div></div></div>
<div id="content" class="pure-g-r">
<div class="pure-u-2-3">
<div class="spacer">

<div class="footer-buttons">
<a class="registerButton pure-button" href="/tr-search-results/"><strong>DONATE OR REGISTER</strong></a>
<a class="signupButton pure-button" href="/events-list/"><strong>VIEW</strong> ALL EVENTS</a>
</div>
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php include 'events-search-include.php'; ?>
<?php the_content(); ?>
<?php include 'include-three-box.php'; ?>
</div>
</div>
<?php comments_template( '', true ); ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>