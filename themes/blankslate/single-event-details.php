<?php get_header(); 
$fr_id = get_post_meta($post->ID, 'fr_id', $single = true);
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>
<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2><?php the_title(); ?> Details</h2>
<p>Location data</p>
</div></div></div>
<div id="content" class="pure-g-r">
<div class="pure-u-2-3">
<div class="spacer">

<h2>Amount Raised: </h2>
<?php the_content(); ?>
<h2>Top Participants</h2>
<ul>
        <script>
        xhr = new XMLHttpRequest();
        xhr.open('GET', "https://secure2.convio.net/bts/site/CRTeamraiserAPI?method=getTopParticipantsData&fr_id=<?php echo get_post_meta($post->ID, 'fr_id', $single = true); ?>&v=1.0&api_key=thooG9Ke", false);
        xhr.send();
        xmlDoc=xhr.responseXML;
        var x=xmlDoc.getElementsByTagName("teamraiserData");
        var n=5;
        for (i=0;i<x.length;i++) {
            if (i == n) { break; }
            document.write("<li>"+x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue+" - "+x[i].getElementsByTagName("total")[0].childNodes[0].nodeValue+"</li>");
          }
        </script>
    </ul>
<h2>Top Teams</h2>
    <ul>
        <script>
        xhr = new XMLHttpRequest();
        xhr.open('GET', "https://secure2.convio.net/bts/site/CRTeamraiserAPI?method=getTopTeamsData&fr_id=<?php echo get_post_meta($post->ID, 'fr_id', $single = true); ?>&v=1.0&api_key=thooG9Ke", false);
        xhr.send();
        xmlDoc=xhr.responseXML;
        var x=xmlDoc.getElementsByTagName("teamraiserData");
        var n=5;
        for (i=0;i<x.length;i++) {
            if (i == n) { break; }
            document.write("<li>"+x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue+" - "+x[i].getElementsByTagName("total")[0].childNodes[0].nodeValue+"</li>");
          }
        </script>
    </ul>


<iframe src="http://www.braintumorcommunity.org/site/PageServer?pagename=pbAPI&s_frid=<?php echo get_post_meta($post->ID, 'fr_id', $single = true); ?>" frameborder="0" allowtransparency="true" seamless="seamless"></iframe>




<?php endwhile; endif; ?>
</div></div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>