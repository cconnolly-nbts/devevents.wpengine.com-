<?php
/*
Template Name: Participant Stories
*/
get_header();
?>
<?php the_post(); ?>
<div class="pure-g-r" id="imgBar"><div class="imgContainer"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></div></div>

<div id="titleBar"><div class="titleContainer"><div class="spacer">
<h2><?php the_title(); ?></h2>
</div></div></div>


<div id="content" class="pure-g-r">
	<div class="pure-u-1">
		<div class="spacer">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">

					<?php the_content(); ?>

<?php
    function download_page($path){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$path);
	curl_setopt($ch, CURLOPT_FAILONERROR,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$retValue = curl_exec($ch);			 
	curl_close($ch);
	return $retValue;
	}
	$rawXML = download_page('http://www.braintumor.org/join-the-fight/share-your-story/stories.xml');
	$processXML = $rawXML;
	$stories = simplexml_load_string($processXML);
	function truncate($str, $len) {
	  $tail = max(0, $len-10);
	  $trunk = substr($str, 0, $tail);
	  $trunk .= strrev(preg_replace('~^..+?[\s,:]\b|^...~', '...', strrev(substr($str, $tail, $len-$tail))));
	  return $trunk;
	}
    foreach ($stories->channel->item as $storyinfo):
        $category=$storyinfo->category;
		if (strpos($category,'Event Participant') !== false) {
        $title=$storyinfo->title;
		$author=$storyinfo->author;
		$age=$storyinfo->age;
		$city=$storyinfo->city;
		$state=$storyinfo->state;
		$url=$storyinfo->link;
		$description=$storyinfo->description;
		$imgurl=$storyinfo->image->url;
		$imgtitle=$storyinfo->image->title;
        echo "<div class='pure-u-1-3'><div class='fivepad'><div class='storybox' style='min-height: 135px;'><div class='tenpad'>";
		if ($imgurl != '') {
			echo "<div class='pure-g-r'><div class='pure-u-1-3'><img class='storyimg' src='" . $imgurl . "' alt='" . $imgtitle . "' /></div><div class='pure-u-2-3'><div class='leftpad'>";
		}
        echo "<h3><a href='" . $url . "'>" . $title . "</a></h3>";
		if (($author && $author != '') || ($age && $age != '')) {
			echo "<strong>";
			if ($author && $author != '') {
				echo $author;
			}
			if (($author && $author != '') && ($age && $age != '')) {
				echo ', ';
			}	
			if ($age && $age != '') {
				echo $age;
			}
			echo "</strong><br />";
		}
		if (($city && $city != '') || ($state && $state != '')) {
			echo "<span style='margin: 0 0 10px 0;'><em>";
			if ($city && $city != '') {
				echo $city;
			}
			if (($city && $city != '') && ($state && $state != '')) {
				echo ', ';
			}	
			if ($state && $state != '') {
				echo $state;
			}
			echo "</em></span><br />";
		}
		echo truncate($description, 100);
		if ($imgurl != '') {
			echo "</div></div></div>";
		}
        echo "</div></div></div></div>";
		}
    endforeach;
?>	
	
</div>

</div>
</div>

</div>
</div>

<?php get_footer(); ?>