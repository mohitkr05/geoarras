	</div><!-- #main -->
	
	<?php arras_before_footer() ?>
	    
	
    </div><!-- #wrapper -->
	<div id="footer-container">

    <div id="footer">
	
				<div class="footer-sidebar-container clearfix">
	
			<?php 
				$footer_sidebars = arras_get_option('footer_sidebars');
				if ($footer_sidebars == '') $footer_sidebars = 1;
				
				for ($i = 1; $i < $footer_sidebars + 1; $i++) : 
			?>
				<ul id="footer-sidebar-<?php echo $i ?>" class="footer-sidebar clearfix xoxo">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar #' . $i) ) : ?>
					<li></li>
					<?php endif; ?>
				</ul>
			<?php endfor; ?>
		</div>
		
		<div class="footer-message">
		
		</div><!-- .footer-message -->
    </div>
</div>
<?php 
arras_footer();
wp_footer(); 
?>
<div class="panel panel-padding-top" id="business-footer">
<h3 class="accent-blue-smoke">Still haven't found what you're looking for?</h3>
<div class="section section_12">
	<div class="col col_2">
		<div class="panel panel-padding-right">
			<h4 class="accent-blue-smoke">Features</h4>
			<div class="ico-features"></div>
			<ul class="list">
				<li class="first"><a href="/cms/ratings-reviews/">Reviews</a></li>

				<li><a href="/cms/get-quotes">Quotes</a></li>
				<li><a href="/cms/deals">Deals</a></li>
				<li><a href="/map.do?showDirections">Directions</a></li>
				<li class="last"><a href="/cms/mobile">Mobile</a></li>
			</ul>
		</div>
	</div>

	<div class="col col_2">
		<div class="panel panel-padding-left panel-padding-right">
			<h4 class="accent-blue">About</h4>
			<div class="ico-about-us"></div>
			<ul class="list">
				<li class="first"><a href="/cms/about-us">About TrueLocal</a></li>
				<li><a href="/cms/faq">FAQ</a></li>

				<li><a href="/cms/media-centre">Media centre</a></li>
				<li class="last"><a autocomplete="off" href="/contact/customer-service.do?url=" class="tl-ui-lightbox ui-lightbox-ajax">Contact us</a></li>
			</ul>
		</div>
	</div>
	<div class="col col_2">
		<div class="panel panel-padding-left panel-padding-right">
			<h4 class="accent-green">Get Involved</h4>

			<div class="ico-get-involved"></div>
			<ul class="list">
				<li class="first"><a href="/cms/badges">Earn badges</a></li>
				<li><a href="/cms/local-star-reviewer">Be a Local Star</a></li>
				<li><a href="/cms/newsletter">Newsletter</a></li>
				<li><a href="http://www.twitter.com/truelocal">Twitter</a></li>
				<li class="last"><a href="http://www.facebook.com/truelocal">Facebook</a></li>

			</ul>
		</div>
	</div>
	<div class="col col_3">
		<div class="panel panel-padding-left panel-padding-right">
			<h4 class="accent-grey">Business Owners</h4>
			<div class="ico-business-owners"></div>
			<ul class="list">

				<li class="first"><a href="/list-your-business">List your business</a></li>
				<li><a href="/cms/business-centre-products">Advertise with TrueLocal</a></li>
				<li><a href="/business-centre">Business Centre</a></li>
				<li class="last"><a href="/cms/faq/#reviews">Handling reviews</a></li>
			</ul>
		</div>
	</div>

	<div class="col col_3">
		<div class="panel panel-padding-left panel-padding-right">
			<ul class="list social-media">
				<li class="list-thumbnails clearfix first">
					<div class="list-thumbnail thumbnail-facebook"></div>
					<div class="list-content">
						<a href="http://www.facebook.com/truelocal">Follow us</a>
					</div>

				</li>
				<li class="list-thumbnails clearfix">
					<div class="list-thumbnail thumbnail-twitter"></div>
					<div class="list-content">
						<a href="http://www.twitter.com/truelocal">Read our tweets</a>
					</div>
				</li>
				<li class="list-thumbnails clearfix last">

					<div class="list-thumbnail thumbnail-newsletter"></div>
					<div class="list-content">
						<a href="/cms/newsletter">Latest in your city</a>
					</div>	
				</li>
			</ul>
		</div>
	</div>
</div>	</div>
</body>
</html>
   