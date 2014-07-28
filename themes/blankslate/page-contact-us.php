<?php
/*
Template Name: Contact us
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

                    <?
                    $options = "";
                    $default_email = "events@braintumor.org";
                    $args = array( 
                        'post_type'         => 'events', 
                        'posts_per_page'    => -1,
                        'orderby'           => 'title',
                        'order'=> 'ASC',
                        'post_parent' => 0
                        );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : 
                        $loop->the_post();
                        $title = get_the_title();
                        if($title != 'Event Details')
                        if($title != 'Volunteer Roles'){
                            $email = get_post_meta($post->ID, "event_email", true);
                            if(empty($email)){
                                $email = $default_email;
                            }
                            $options .= '<option data-email="'.$email.'">'.$title.'</option>';
                        }
                    endwhile;
                    ?>

                    <form id="contact-us-form" class="pure-form pure-form-aligned">
                        <fieldset>
                            <div class="pure-control-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" placeholder="Full name" class="pure-u-1-2" required>
                            </div>
                            <div class="pure-control-group">
                                <label for="email">Email Address</label>
                                <input name="email" type="email" placeholder="Email Address" class="pure-u-1-2" required>
                            </div>
                            <div class="pure-control-group">
                                <label for="event">What event are you inquiring about?</label>
                                <select id="event" name="event" class="pure-input-1-2" required style="height:25px">
                                    <option value="">Select an event</option>
                                    <option data-email="events@braintumor.org">General Inquire</option>
                                    <?php echo $options; ?>
                                </select>
                            </div>
                            <div class="pure-control-group">
                                <label for="message">What can we help you with?</label>
                                <textarea name="message" required rows="5" class="pure-u-1-2"></textarea>
                            </div>
                            <div class="pure-controls">
                                <input type="hidden" id="event_email" name="event_email" value="<?php echo $default_email;?>" />
                                <button id="submit-button" type="submit" class="pure-button pure-button-primary">Submit</button>
                            </div>
                        </fieldset>
                    </form>
                    <div id="status-panel"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('ready',function(){
    $('#event').on('change',function(){
        var optionSelected = $("option:selected", this);
        var email = optionSelected[0].getAttribute('data-email');
        $('#event_email').val(email);
    })
    $('#contact-us-form').on('submit',function(e){
        e.preventDefault();
        $('#status-panel').hide();
        $('#status-panel').html('');
        $('#submit-button').addClass('pure-button-disabled').html('sending...')
        var data = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo get_template_directory_uri() ?>/send-email.php',
            data: data,
            success:function(data){
                // success! 
                console.log('1');
                var json = jQuery.parseJSON(data);
                if(json.error){
                    console.log('2');
                    console.log(json);
                    $('#status-panel').html('<div class="error">'+json.msg+'</div>');
                    $('#status-panel').show();
                    $('#submit-button').removeClass('pure-button-disabled').html('Submit');
                }else{
                    console.log('3');
                    $('#status-panel').html('<div class="success">'+json.msg+'</div>');
                    $('#status-panel').show();
                    $('#contact-us-form').remove();
                }
            },
            error:function(){
                console.log('4');
                $('#status-panel').html('<div class="error">There seems to be a problem. Please refresh the page and try again.</div>');
                $('#status-panel').show();
            }
        });
;   })
})
</script>

<?php get_footer(); ?>