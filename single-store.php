<?php get_header(); ?>

<div id="content" class="section">
<?php arras_above_content() ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php arras_above_post() ?>
	<div id="post-<?php the_ID() ?>" <?php arras_single_post_class() ?>>

        <?php arras_postheader() ?>
		
         
     
        <div class="entry-content clearfix">
		<?php the_content( __('<p>Read the rest of this entry &raquo;</p>', 'arras') ); ?>  
        <?php wp_link_pages(array('before' => __('<p><strong>Pages:</strong> ', 'arras'), 
			'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
   <?php if(get_post_meta($post->ID,'currentoffer',true) ){?>
		
		<h4 class="dealinfo"> <?php _e('Current Deal/Offer');?> :  <?php echo get_post_meta($post->ID,'currentoffer',true);?>  </h4>
		<?php }?>
   <?php if(get_post_meta($post->ID,'currentofferstart',true)  || get_post_meta($post->ID,'currentofferend',true) ){?>
		
		<p> From  <?php echo get_post_meta($post->ID,'currentofferstart',true);?>  till <?php echo get_post_meta($post->ID,'currentofferend',true);?></p>
		<?php }?>
		
		<?php arras_postfooter() ?>

     
    </div>
	<h1> Related Deals</h1>
	 <?php cptr();?>
 
	<?php arras_below_post() ?>
	<script type="text/javascript"><!--
google_ad_client = "ca-pub-5446825791916432";
/* 468x60, created 7/11/09 */
google_ad_slot = "0666791223";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
	<a name="comments"></a>
    <div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-num-posts="10" data-width="500"></div>
	<?php arras_below_comments() ?>
    
<?php endwhile; else: ?>

<?php arras_post_notfound() ?>

<?php endif; ?>

<?php arras_below_content() ?>
</div><!-- #content -->

</div><!-- #container -->

<?php wp_reset_query() ?>
<div id="primary" class="aside main-aside sidebar">
<?php arras_above_sidebar() ?>  
	<ul class="xoxo">
		<li class="widgetcontainer clearfix">
		
		
				<h5 class="widgettitle"><?php _e('Store Details', 'arras') ?></h5>
			<?php echo GeoMashup::map('height=200&width=260&zoom=12&add_overview_control=false&add_map_type_control=false');?>	  <br/>
      	<p> Address : <strong> <?php echo get_post_meta($post->ID,'address',true);?> </strong>
        </p>
		 <?php if(get_post_meta($post->ID,'website',true)){
			 $website = get_post_meta($post->ID,'website',true);
			 if(!strstr($website,'http'))
			 {
				 $website = 'http://'.get_post_meta($post->ID,'website',true);
			 }
			 ?>
        <?php if($website && get_post_meta($post->ID,'web_show',true)!='No'){?>
		<p> <a href="<?php echo $website;?>"><strong><?php _e('Website');?></strong></a>  </p>
        <?php }?>
		<?php }?>
         <?php if(get_post_meta($post->ID,'contact',true) ){?>
		<p> <?php _e('Contact');?> :  <?php echo get_post_meta($post->ID,'contact',true);?>  </p>
		<?php }?>
		 <?php if(get_post_meta($post->ID,'email',true)){?>
		<p> <?php _e('email');?> : <a href="mailto:<?php echo get_post_meta($post->ID,'email',true);?>">  <?php echo get_post_meta($post->ID,'email',true);?> </a> </p>
		<?php }?>
     <?php if(get_post_meta($post->ID,'timing',true) ){?>
		<p> <?php _e('Timings');?> :  <?php echo get_post_meta($post->ID,'timing',true);?>  </p>
		<?php }?>
		
         
	
  </div>
      </li>
	 

<ul>

</ul>
		
    <script type="text/javascript"><!--
google_ad_client = "ca-pub-5446825791916432";
/* 300x250, created 9/24/09 */
google_ad_slot = "7808898885";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
      
        
        </ul>
		
</div><!-- #primary -->


<?php get_footer(); ?>