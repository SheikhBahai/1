<?php 
/*
 * All themes functions
 *
 */

 
/*
 * business featured image
 *
 */
if ( ! function_exists( 'Business_Responsiveness_post_thumbnail' ) ) :
function Business_Responsiveness_post_thumbnail() {
$business_obj = new Business_Responsiveness_settings_array();
$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() );
	
	if($option['blog_feature_image_enable']==true):

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
		?>
			<?php if( has_post_thumbnail() ){ ?>
			<div class="rdn-featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php } ?>
			
		<?php
			 
		else : ?>
		
		<?php if( has_post_thumbnail() ){ ?>
		<div class="rdn-featured-image">
			<a href="<?php the_permalink(); ?>" class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<?php } ?>

		<?php endif; // End is_singular()
		
	endif;
}
endif;

/*
 * business meta
 *
 */
if ( ! function_exists( 'Business_Responsiveness_post_meta' ) ) :
function Business_Responsiveness_post_meta(){
$business_obj = new Business_Responsiveness_settings_array();
$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() );
	
	if($option['blog_meta_enable']==true):
	?>
	<div class="entry-meta">
		<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php _e('Posted by: ','business-responsiveness' ); echo get_the_author_link();?></a></span>
		<span class="entry-date">
			<a href="<?php echo esc_url( get_month_link( get_post_time('Y') ,get_post_time('m') ) ); ?>">
				<?php _e('Posted on: ','business-responsiveness' ); echo esc_attr( get_the_date( get_option('date_format') ) ); ?>
			</a>
		</span>
		<?php the_tags( '<span class="tag-links">', ' , ', '</span>' ); ?>
	</div>
	<?php
	endif;
}
endif;


/**
 * Sets the content width in pixels.
 *
 * @global int $content_width
 */
function Business_Responsiveness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'Business_Responsiveness_content_width', 728 );
}
add_action( 'after_setup_theme', 'Business_Responsiveness_content_width', 0 );

add_filter('get_avatar','Business_Responsiveness_gravatar_class');
function Business_Responsiveness_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-circle", $class);
    return $class;
}

if ( ! function_exists( 'Business_Responsiveness_author_detail' ) ) :
function Business_Responsiveness_author_detail(){
?>
<section class="blog-author">
	<div class="media">
		<div class="pull-left">
			<?php echo get_avatar( get_the_author_meta( 'ID') , 103); ?>
		</div>
		<div class="media-body">
			<h3 class="author-title"><?php the_author(); ?></h3>
			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
	</div>
</section>
<?php 
}
endif;

if ( ! function_exists( 'Business_Responsiveness_shop_content' ) ) :
/**
 * Displays shop section products
 *
 */
function Business_Responsiveness_shop_content( $shop_items, $is_callback = false ) {
	$args = array(
		'post_type' => 'product',
	);
	
	$args['posts_per_page'] = ! empty( $shop_items ) ? absint( $shop_items ) : 4;
	
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) :
	$i = 1;
		echo '<div class="row">';
		while ( $loop->have_posts() ) :
			$loop->the_post();
			global $product;
			global $post;
			?>
			<div class="col-md-3 col-sm-6 product_item">
				<div class="product-item-area">
				
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="product-image-area">
						<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>
					<?php endif; ?>
					
					<div class="product-category">
						<?php 
						if ( function_exists( 'wc_get_product_category_list' ) ) {
								$prod_id = get_the_ID();
								$product_categories = wc_get_product_category_list( $prod_id );
							} else {
								$product_categories = $product->get_categories();
							}
							
						if ( ! empty( $product_categories ) ) {
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'rel' => array(),
								),
							);
							echo '<h6 class="category">';
							echo wp_kses( $product_categories, $allowed_html );
							echo '</h6>';
						} ?>
					</div>
					
					<div class="product-content">
						<div class="product-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h3><?php esc_html( the_title() ); ?></h3>
							</a>
						</div>
						
						<?php if ( $post->post_excerpt ) : ?>
						<div class="product-description">
							<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
						</div>
						<?php endif; ?>
						
						<div class="product-footer">
								<?php
							$product_price = $product->get_price_html();

							if ( ! empty( $product_price ) ) {

								echo '<div class="price"><h3>';

								echo wp_kses(
									$product_price, array(
										'span' => array(
											'class' => array(),
										),
										'del' => array(),
									)
								);

								echo '</h3></div>';

							}
							?>

							<div class="start-add-to-cart">
								<?php Business_Responsiveness_add_to_cart(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			if ( $i % 4 == 0 ) {
					echo '<div class="clearfix"></div>';
				}
				$i++;
				
		endwhile;
		echo '</div>';
	endif;
}
endif;
if ( ! function_exists( 'Business_Responsiveness_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 */
function Business_Responsiveness_the_custom_logo() {
	the_custom_logo();
}
endif;
add_action('wp_head','Business_Responsiveness_color_scheme');
/* Business-responsive color scheme settings */
function Business_Responsiveness_color_scheme(){
	$obj = new Business_Responsiveness_settings_array();
	$option = wp_parse_args(  get_option( 'business_r_option', array() ), $obj->default_data() );
	$color = $option['custom_color_scheme'];
	echo '<style>';
		Business_Responsiveness_set_color( $color );
	echo '</style>';
}
function Business_Responsiveness_set_color( $color ){
	$obj = new Business_Responsiveness_settings_array();
	$option = wp_parse_args(  get_option( 'business_r_option', array() ), $obj->default_data() );
	
	list($r, $g, $b) = sscanf( $color, "#%02x%02x%02x");
	?>
	a,
	a:hover,
	a:focus,
	a:active,
	.navbar-default .navbar-nav > li > a:hover,
	.navbar-default .navbar-nav > li > a:focus,
	.navbar-default .navbar-nav > .active > a,
	.navbar-default .navbar-nav > .active > a:hover,
	.navbar-default .navbar-nav > .active > a:focus,
	.navbar-default .navbar-nav > .open > a,
	.navbar-default .navbar-nav > .open > a:hover,
	.navbar-default .navbar-nav > .open > a:focus,
	.navbar-default .navbar-nav > .dropdown.active > a,	
	#rdn-footer .widget .tagcloud a,
	.rdn-callout-btn:hover,
	.rdn-service-icon i.fa,
	.more-link,
	.rdn-portfolio-tabs li a,
	.team-title h5,
	.team-title:hover h5,
	.team-title:focus h5,
	.entry-title a:hover,
	.entry-title a:focus, 
	.entry-meta span a:hover, 
	.entry-meta span a:focus,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	#rdn-footer .widget li a:hover, 
	#rdn-footer .widget li a:focus, 
	#rdn-footer .widget li a:active, 
	.widget .news-title a:hover, 
	.widget .news-title a:focus,
	.widget-title a, 
	.widget-title a:hover,  
	.widget-title a:focus, 
	.widget  li  a:hover, 
	.widget  li  a:focus,  
	.widget li:before, 
	.widget_calendar #wp-calendar th, 
	.tagcloud a, 
	.widget_text a:hover, 
	.widget_text a:focus, 
	#rdn-footer .widget .news-title a:hover, 
	#rdn-footer .widget .news-title a:focus,
	.rdn-footer-menu li a:hover, 
	.rdn-footer-menu li a:focus,
	#rdn-footer .widget a:hover, 
	#rdn-footer .widget a:focus,
	.rdn-copyright p > a, 
	.rdn-copyright p > a:hover, 
	.rdn-copyright p > a:focus,
	.rdn-sub-header li .active, 
	.rdn-sub-header ul li:before,
	.comments-title:after, 
	.comment-reply-title:after,
	.reply:before,
	.pagination li a,
	.page-links a,
	.entry-style-date span strong,
	.pricing_wrapper .pricing_header h1,
	.pricing_wrapper.active .pricing_footer a:hover,
	.pricing_wrapper.active .pricing_footer a:focus,
	.pricing_wrapper .pricing_footer a,
	.error404_title{
		color: <?php echo esc_attr($color); ?>;
	}
	
	::selection,
	#rdn-top-header,
	.dropdown-menu > .active > a, 
	.dropdown-menu > li > a:hover, 
	.dropdown-menu > li > a:focus,
	.dropdown-menu > .active > a:hover, 
	.dropdown-menu > .active > a:focus,
	.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, 
	.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus,
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, 
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus,
	.carousel-indicators .active,
	.section-desc:before,
	.more-link:hover, .more-link:focus,
	.rdn-portfolio-tabs .active,
	.carousel-control-testi,
	.carousel-control-client.left,  
	.carousel-control-client.right,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
    .contact-form-area .wpcf7-submit,
	.widget .widget-title:after, 
	.widget_search .search-submit,  
	.widget_calendar #wp-calendar caption, 
	.widget_calendar tbody a, 
	.widget_calendar tbody a:hover, 
	.widget_calendar tbody a:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.pagination .current a, 
	.pagination .current:hover a, 
	.pagination .current:focus a,
	.pagination li:hover a, 
	.pagination li:focus a,
	.nav-links li span.current,
	.nav-links li:hover span.current, 
	.nav-links li:focus span.current,
	.woocommerce #respond input#submit.alt, 
	 .woocommerce a.button.alt, 
	 .woocommerce button.button.alt, 
	 .woocommerce input.button.alt,
	 .woocommerce #respond input#submit.alt:hover, 
	 .woocommerce a.button.alt:hover, 
	 .woocommerce button.button.alt:hover, 
	 .woocommerce input.button.alt:hover,
	 .woocommerce #respond input#submit.disabled:hover, 
	 .woocommerce #respond input#submit:disabled:hover, 
	 .woocommerce #respond input#submit:disabled[disabled]:hover, 
	 .woocommerce a.button.disabled:hover, 
	 .woocommerce a.button:disabled:hover, 
	 .woocommerce a.button:disabled[disabled]:hover, 
	 .woocommerce button.button.disabled:hover, 
	 .woocommerce button.button:disabled:hover, 
	 .woocommerce button.button:disabled[disabled]:hover, 
	 .woocommerce input.button.disabled:hover, 
	 .woocommerce input.button:disabled:hover, 
	 .woocommerce input.button:disabled[disabled]:hover,
	 .woocommerce #respond input#submit.disabled, 
	 .woocommerce #respond input#submit:disabled, 
	 .woocommerce #respond input#submit:disabled[disabled], 
	 .woocommerce a.button.disabled, .woocommerce a.button:disabled, 
	 .woocommerce a.button:disabled[disabled], 
	 .woocommerce button.button.disabled, 
	 .woocommerce button.button:disabled, 
	 .woocommerce button.button:disabled[disabled], 
	 .woocommerce input.button.disabled, 
	 .woocommerce input.button:disabled, 
	 .woocommerce input.button:disabled[disabled],
	 .woocommerce #respond input#submit, 
	 .woocommerce a.button, 
	 .woocommerce button.button, 
	 .woocommerce input.button,
	 #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
	 .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
	 .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
	 .woocommerce span.onsale,
	 .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	 .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	 .product_item .added_to_cart.wc-forward,
	 .post-style-header,
	.page-links > a:hover,
	.rdn-featured-image-overlay-inner a,
	.rdn_page_scroll,
	.rdn_page_scroll
	.pricing_wrapper.active .pricing_footer a,
	.footer-social-icons li:hover,
	.pricing_wrapper .pricing_footer a:hover, 
	.pricing_wrapper .pricing_footer a:focus,
	.pricing_ribben,
	.more-link:hover,
	.more-link:focus,
	.pricing_wrapper .pricing_footer a:hover, 
	.pricing_wrapper .pricing_footer a:focus,
	.error404_btn:hover,
	.error404_btn:focus{
		background-color: <?php echo esc_attr($color); ?>;
	}
	
	.navbar-default .navbar-nav > li > a:hover,
	.navbar-default .navbar-nav > li > a:focus,
	.navbar-default .navbar-nav > .active > a,
	.navbar-default .navbar-nav > .active > a:hover,
	.navbar-default .navbar-nav > .active > a:focus,
	.navbar-default .navbar-nav > .open > a,
	.navbar-default .navbar-nav > .open > a:hover,
	.navbar-default .navbar-nav > .open > a:focus,
	.navbar-default .navbar-nav > .dropdown.active > a,
	.dropdown-menu > .active > a, 
	.dropdown-menu > li > a:hover, 
	.dropdown-menu > li > a:focus,
	.dropdown-menu > .active > a:hover, 
	.dropdown-menu > .active > a:focus,
	#rdn-footer .widget .tagcloud a
	{
    	border-bottom: 2px solid <?php echo esc_attr($color); ?>;
	}


	.carousel-caption h1{ 
		background-color: rgba(<?php echo esc_attr($r); ?>, <?php echo esc_attr($g); ?>, <?php echo esc_attr($b); ?>, 0.7); 
	}
	.carousel-caption h1{
		background-color: transparent;
	}

	.carousel-caption .rdn-slider-btn,
	.rdn-service-btn,
	.rdn-service-btn:hover,
	.team-more-link{ 
		background: linear-gradient(-48deg, <?php echo esc_attr($color); ?> 46%, rgba(0, 0, 0, 0.54) 48%);
	}
	.rdn-page-social li:hover{ 
		background: linear-gradient(-98deg, <?php echo esc_attr($color); ?> 46%, rgba(0, 0, 0, 0.54) 48%);
	}
	.rdn-page-social li:hover,
	.pagination li a, 
	.pagination li a:hover, 
	.pagination li a:focus,
	.nav-links li span.current, 
	.nav-links li:hover span.current, 
	.nav-links li:focus span.current,
	.page-links a,
	.more-link,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.error404_btn{ border:1px solid <?php echo esc_attr($color); ?>;}
	
	blockquote { 
		border-left: 4px solid <?php echo esc_attr($color); ?>;
	}
	
	.entry-style-date span strong{
		border:5px solid <?php echo esc_attr($color); ?>;
	}

	.pricing_wrapper.active,
	.pricing_wrapper.active .pricing_footer a,
	.pricing_wrapper .pricing_footer a:hover, 
	.pricing_wrapper .pricing_footer a:focus{
		border-color: <?php echo esc_attr($color); ?>;
	}
	
	
	<?php if( $option['site_title'] != '' ){ ?>
	.site-title{ color: <?php echo esc_attr($option['site_title']); ?>; }
	<?php } ?>
	
	<?php if( $option['footer_background'] != '' ){ ?>
	.rdn-footer-top{
		    background: <?php echo esc_attr($option['footer_background']); ?>;
	}
	<?php } ?>
	
	<?php if( $option['footer_info_background'] != '' ){ ?>
	.rdn-footer-bottom{
		    background: <?php echo esc_attr($option['footer_info_background']); ?>;
	}
	<?php } ?>
	
	body { 
		<?php if( $option['general_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['general_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['general_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['general_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['general_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['general_fontstyle']); ?>; 
		<?php } ?>
	}
	h1, .h1 { 
		<?php if( $option['h1_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h1_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h1_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h1_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h1_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h1_fontstyle']); ?>; 
		<?php } ?> 
	}
	h2, .h2 { 
		<?php if( $option['h2_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h2_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h2_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h2_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h2_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h2_fontstyle']); ?>; 
		<?php } ?>
	}
	h3, .h3 { 
		<?php if( $option['h3_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h3_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h3_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h3_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h3_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h3_fontstyle']); ?>; 
		<?php } ?> 
	}
	h4, .h4 { 
		<?php if( $option['h4_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h4_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h4_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h4_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h4_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h4_fontstyle']); ?>; 
		<?php } ?>
	}
	h5, .h5 { 
		<?php if( $option['h5_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h5_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h5_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h5_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h5_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h5_fontstyle']); ?>; 
		<?php } ?>
	}
	h6, .h6 { 
		<?php if( $option['h6_fontsize'] != '' ){ ?>
		font-size: <?php echo esc_attr($option['h6_fontsize']); ?>px; 
		<?php } ?>
		<?php if( $option['h6_fontfamily'] != '' ){ ?>
		font-family: '<?php echo esc_attr($option['h6_fontfamily']); ?>', sans-serif; 
		<?php } ?>
		<?php if( $option['h6_fontstyle'] != '' ){ ?>
		font-style: <?php echo esc_attr($option['h6_fontstyle']); ?>; 
		<?php } ?>
	}
	
	
	<?php
}


/* Business Typography Settings */
function Business_Responsiveness_font_size(){
	$font_size = array();
	for( $i=9; $i<=100; $i++ ){		
	
		$font_size[$i] = $i;
		
	}
	return $font_size;
}
function Business_Responsiveness_font_family(){

	$font_family = array(	"ABeeZee" => __("ABeeZee","business-responsiveness"),
							"Abel" => __("Abel","business-responsiveness"),
							"Abril Fatface" => __("Abril Fatface","business-responsiveness"),
							"Aclonica" => __("Aclonica","business-responsiveness"),
							"Acme" => __("Acme","business-responsiveness"),
							"Actor" => __("Actor","business-responsiveness"),
							"Adamina" => __("Adamina","business-responsiveness"),
							"Advent Pro" => __("Advent Pro","business-responsiveness"),
							"Aguafina Script" => __("Aguafina Script","business-responsiveness"),
							"Akronim" => __("Akronim","business-responsiveness"),
							"Aladin" => __("Aladin","business-responsiveness"),
							"Aldrich" => __("Aldrich","business-responsiveness"),
							"Alegreya" => __("Alegreya","business-responsiveness"),
							"Alegreya SC" => __("Alegreya SC","business-responsiveness"),
							"Alex Brush" => __("Alex Brush","business-responsiveness"),
							"Alfa Slab One" => __("Alfa Slab One","business-responsiveness"),
							"Alice" => __("Alice","business-responsiveness"),
							"Alike" => __("Alike","business-responsiveness"),
							"Alike Angular" => __("Alike Angular","business-responsiveness"),
							"Allan" => __("Allan","business-responsiveness"),
							"Allerta" => __("Allerta","business-responsiveness"),
							"Allerta Stencil" => __("Allerta Stencil","business-responsiveness"),
							"Allura" => __("Allura","business-responsiveness"),
							"Almendra" => __("Almendra","business-responsiveness"),
							"Almendra Display" => __("Almendra Display","business-responsiveness"),
							"Almendra SC" => __("Almendra SC","business-responsiveness"),
							"Amarante" => __("Amarante","business-responsiveness"),
							"Amaranth" => __("Amaranth","business-responsiveness"),
							"Amatic SC" => __("Amatic SC","business-responsiveness"),
							"Amethysta" => __("Amethysta","business-responsiveness"),
							"Anaheim" => __("Anaheim","business-responsiveness"),
							"Andada" => __("Andada","business-responsiveness"),
							"Andika" => __("Andika","business-responsiveness"),
							"Angkor" => __("Angkor","business-responsiveness"),
							"Annie Use Your Telescope" => __("Annie Use Your Telescope","business-responsiveness"),
							"Anonymous Pro" => __("Anonymous Pro","business-responsiveness"),
							"Antic" => __("Antic","business-responsiveness"),
							"Antic Didone" => __("Antic Didone","business-responsiveness"),
							"Antic Slab" => __("Antic Slab","business-responsiveness"),
							"Anton" => __("Anton","business-responsiveness"),
							"Arapey" => __("Arapey","business-responsiveness"),
							"Arbutus" => __("Arbutus","business-responsiveness"),
							"Arbutus Slab" => __("Arbutus Slab","business-responsiveness"),
							"Architects Daughter" => __("Architects Daughter","business-responsiveness"),
							"Archivo Black" => __("Archivo Black","business-responsiveness"),
							"Archivo Narrow" => __("Archivo Narrow","business-responsiveness"),
							"Arimo" => __("Arimo","business-responsiveness"),
							"Arizonia" => __("Arizonia","business-responsiveness"),
							"Armata" => __("Armata","business-responsiveness"),
							"Artifika" => __("Artifika","business-responsiveness"),
							"Arvo" => __("Arvo","business-responsiveness"),
							"Asap" => __("Asap","business-responsiveness"),
							"Asset" => __("Asset","business-responsiveness"),
							"Astloch" => __("Astloch","business-responsiveness"),
							"Asul" => __("Asul","business-responsiveness"),
							"Atomic Age" => __("Atomic Age","business-responsiveness"),
							"Aubrey" => __("Aubrey","business-responsiveness"),
							"Audiowide" => __("Audiowide","business-responsiveness"),
							"Autour One" => __("Autour One","business-responsiveness"),
							"Average" => __("Average","business-responsiveness"),
							"Average Sans" => __("Average Sans","business-responsiveness"),
							"Averia Gruesa Libre" => __("Averia Gruesa Libre","business-responsiveness"),
							"Averia Libre" => __("Averia Libre","business-responsiveness"),
							"Averia Sans Libre" => __("Averia Sans Libre","business-responsiveness"),
							"Averia Serif Libre" => __("Averia Serif Libre","business-responsiveness"),
							"Bad Script" => __("Bad Script","business-responsiveness"),
							"Balthazar" => __("Balthazar","business-responsiveness"),
							"Bangers" => __("Bangers","business-responsiveness"),
							"Basic" => __("Basic","business-responsiveness"),
							"Battambang" => __("Battambang","business-responsiveness"),
							"Baumans" => __("Baumans","business-responsiveness"),
							"Bayon" => __("Bayon","business-responsiveness"),
							"Belgrano" => __("Belgrano","business-responsiveness"),
							"Belleza" => __("Belleza","business-responsiveness"),
							"BenchNine" => __("BenchNine","business-responsiveness"),
							"Bentham" => __("Bentham","business-responsiveness"),
							"Berkshire Swash" => __("Berkshire Swash","business-responsiveness"),
							"Bevan" => __("Bevan","business-responsiveness"),
							"Bigelow Rules" => __("Bigelow Rules","business-responsiveness"),
							"Bigshot One" => __("Bigshot One","business-responsiveness"),
							"Bilbo" => __("Bilbo","business-responsiveness"),
							"Bilbo Swash Caps" => __("Bilbo Swash Caps","business-responsiveness"),
							"Bitter" => __("Bitter","business-responsiveness"),
							"Black Ops One" => __("Black Ops One","business-responsiveness"),
							"Bokor" => __("Bokor","business-responsiveness"),
							"Bonbon" => __("Bonbon","business-responsiveness"),
							"Boogaloo" => __("Boogaloo","business-responsiveness"),
							"Bowlby One" => __("Bowlby One","business-responsiveness"),
							"Bowlby One SC" => __("Bowlby One SC","business-responsiveness"),
							"Brawler" => __("Brawler","business-responsiveness"),
							"Bree Serif" => __("Bree Serif","business-responsiveness"),
							"Bubblegum Sans" => __("Bubblegum Sans","business-responsiveness"),
							"Bubbler One" => __("Bubbler One","business-responsiveness"),
							"Buda" => __("Buda","business-responsiveness"),
							"Buenard" => __("Buenard","business-responsiveness"),
							"Butcherman" => __("Butcherman","business-responsiveness"),
							"Butterfly Kids" => __("Butterfly Kids","business-responsiveness"),
							"Cabin" => __("Cabin","business-responsiveness"),
							"Cabin Condensed" => __("Cabin Condensed","business-responsiveness"),
							"Cabin Sketch" => __("Cabin Sketch","business-responsiveness"),
							"Caesar Dressing" => __("Caesar Dressing","business-responsiveness"),
							"Cagliostro" => __("Cagliostro","business-responsiveness"),
							"Calligraffitti" => __("Calligraffitti","business-responsiveness"),
							"Cambo" => __("Cambo","business-responsiveness"),
							"Candal" => __("Candal","business-responsiveness"),
							"Cantarell" => __("Cantarell","business-responsiveness"),
							"Cantata One" => __("Cantata One","business-responsiveness"),
							"Cantora One" => __("Cantora One","business-responsiveness"),
							"Capriola" => __("Capriola","business-responsiveness"),
							"Cardo" => __("Cardo","business-responsiveness"),
							"Carme" => __("Carme","business-responsiveness"),
							"Carrois Gothic" => __("Carrois Gothic","business-responsiveness"),
							"Carrois Gothic SC" => __("Carrois Gothic SC","business-responsiveness"),
							"Carter One" => __("Carter One","business-responsiveness"),
							"Caudex" => __("Caudex","business-responsiveness"),
							"Cedarville Cursive" => __("Cedarville Cursive","business-responsiveness"),
							"Ceviche One" => __("Ceviche One","business-responsiveness"),
							"Changa One" => __("Changa One","business-responsiveness"),
							"Chango" => __("Chango","business-responsiveness"),
							"Chau Philomene One" => __("Chau Philomene One","business-responsiveness"),
							"Chela One" => __("Chela One","business-responsiveness"),
							"Chelsea Market" => __("Chelsea Market","business-responsiveness"),
							"Chenla" => __("Chenla","business-responsiveness"),
							"Cherry Cream Soda" => __("Cherry Cream Soda","business-responsiveness"),
							"Cherry Swash" => __("Cherry Swash","business-responsiveness"),
							"Chewy" => __("Chewy","business-responsiveness"),
							"Chicle" => __("Chicle","business-responsiveness"),
							"Chivo" => __("Chivo","business-responsiveness"),
							"Cinzel" => __("Cinzel","business-responsiveness"),
							"Cinzel Decorative" => __("Cinzel Decorative","business-responsiveness"),
							"Clicker Script" => __("Clicker Script","business-responsiveness"),
							"Coda" => __("Coda","business-responsiveness"),
							"Coda Caption" => __("Coda Caption","business-responsiveness"),
							"Codystar" => __("Codystar","business-responsiveness"),
							"Combo" => __("Combo","business-responsiveness"),
							"Comfortaa" => __("Comfortaa","business-responsiveness"),
							"Coming Soon" => __("Coming Soon","business-responsiveness"),
							"Concert One" => __("Concert One","business-responsiveness"),
							"Condiment" => __("Condiment","business-responsiveness"),
							"Content" => __("Content","business-responsiveness"),
							"Contrail One" => __("Contrail One","business-responsiveness"),
							"Convergence" => __("Convergence","business-responsiveness"),
							"Cookie" => __("Cookie","business-responsiveness"),
							"Copse" => __("Copse","business-responsiveness"),
							"Corben" => __("Corben","business-responsiveness"),
							"Courgette" => __("Courgette","business-responsiveness"),
							"Cousine" => __("Cousine","business-responsiveness"),
							"Coustard" => __("Coustard","business-responsiveness"),
							"Covered By Your Grace" => __("Covered By Your Grace","business-responsiveness"),
							"Crafty Girls" => __("Crafty Girls","business-responsiveness"),
							"Creepster" => __("Creepster","business-responsiveness"),
							"Crete Round" => __("Crete Round","business-responsiveness"),
							"Crimson Text" => __("Crimson Text","business-responsiveness"),
							"Croissant One" => __("Croissant One","business-responsiveness"),
							"Crushed" => __("Crushed","business-responsiveness"),
							"Cuprum" => __("Cuprum","business-responsiveness"),
							"Cutive" => __("Cutive","business-responsiveness"),
							"Cutive Mono" => __("Cutive Mono","business-responsiveness"),
							"Damion" => __("Damion","business-responsiveness"),
							"Dancing Script" => __("Dancing Script","business-responsiveness"),
							"Dangrek" => __("Dangrek","business-responsiveness"),
							"Dawning of a New Day" => __("Dawning of a New Day","business-responsiveness"),
							"Days One" => __("Days One","business-responsiveness"),
							"Delius" => __("Delius","business-responsiveness"),
							"Delius Swash Caps" => __("Delius Swash Caps","business-responsiveness"),
							"Delius Unicase" => __("Delius Unicase","business-responsiveness"),
							"Della Respira" => __("Della Respira","business-responsiveness"),
							"Denk One" => __("Denk One","business-responsiveness"),
							"Devonshire" => __("Devonshire","business-responsiveness"),
							"Didact Gothic" => __("Didact Gothic","business-responsiveness"),
							"Diplomata" => __("Diplomata","business-responsiveness"),
							"Diplomata SC" => __("Diplomata SC","business-responsiveness"),
							"Domine" => __("Domine","business-responsiveness"),
							"Donegal One" => __("Donegal One","business-responsiveness"),
							"Doppio One" => __("Doppio One","business-responsiveness"),
							"Dorsa" => __("Dorsa","business-responsiveness"),
							"Dosis" => __("Dosis","business-responsiveness"),
							"Dr Sugiyama" => __("Dr Sugiyama","business-responsiveness"),
							"Droid Sans" => __("Droid Sans","business-responsiveness"),
							"Droid Sans Mono" => __("Droid Sans Mono","business-responsiveness"),
							"Droid Serif" => __("Droid Serif","business-responsiveness"),
							"Duru Sans" => __("Duru Sans","business-responsiveness"),
							"Dynalight" => __("Dynalight","business-responsiveness"),
							"EB Garamond" => __("EB Garamond","business-responsiveness"),
							"Eagle Lake" => __("Eagle Lake","business-responsiveness"),
							"Eater" => __("Eater","business-responsiveness"),
							"Ek Mukta"=> __("Ek Mukta","business-responsiveness"),
							"Economica" => __("Economica","business-responsiveness"),
							"Electrolize" => __("Electrolize","business-responsiveness"),
							"Elsie" => __("Elsie","business-responsiveness"),
							"Elsie Swash Caps" => __("Elsie Swash Caps","business-responsiveness"),
							"Emblema One" => __("Emblema One","business-responsiveness"),
							"Emilys Candy" => __("Emilys Candy","business-responsiveness"),
							"Engagement" => __("Engagement","business-responsiveness"),
							"Englebert" => __("Englebert","business-responsiveness"),
							"Enriqueta" => __("Enriqueta","business-responsiveness"),
							"Erica One" => __("Erica One","business-responsiveness"),
							"Esteban" => __("Esteban","business-responsiveness"),
							"Euphoria Script" => __("Euphoria Script","business-responsiveness"),
							"Ewert" => __("Ewert","business-responsiveness"),
							"Exo" => __("Exo","business-responsiveness"),
							"Expletus Sans" => __("Expletus Sans","business-responsiveness"),
							"Fanwood Text" => __("Fanwood Text","business-responsiveness"),
							"Fascinate" => __("Fascinate","business-responsiveness"),
							"Fascinate Inline" => __("Fascinate Inline","business-responsiveness"),
							"Faster One" => __("Faster One","business-responsiveness"),
							"Fasthand" => __("Fasthand","business-responsiveness"),
							"Federant" => __("Federant","business-responsiveness"),
							"Federo" => __("Federo","business-responsiveness"),
							"Felipa" => __("Felipa","business-responsiveness"),
							"Fenix" => __("Fenix","business-responsiveness"),
							"Finger Paint" => __("Finger Paint","business-responsiveness"),
							"Fjalla One" => __("Fjalla One","business-responsiveness"),
							"Fjord One" => __("Fjord One","business-responsiveness"),
							"Flamenco" => __("Flamenco","business-responsiveness"),
							"Flavors" => __("Flavors","business-responsiveness"),
							"Fondamento" => __("Fondamento","business-responsiveness"),
							"Fontdiner Swanky" => __("Fontdiner Swanky","business-responsiveness"),
							"Forum" => __("Forum","business-responsiveness"),
							"Francois One" => __("Francois One","business-responsiveness"),
							"Freckle Face" => __("Freckle Face","business-responsiveness"),
							"Fredericka the Great" => __("Fredericka the Great","business-responsiveness"),
							"Fredoka One" => __("Fredoka One","business-responsiveness"),
							"Freehand" => __("Freehand","business-responsiveness"),
							"Fresca" => __("Fresca","business-responsiveness"),
							"Frijole" => __("Frijole","business-responsiveness"),
							"Fruktur" => __("Fruktur","business-responsiveness"),
							"Fugaz One" => __("Fugaz One","business-responsiveness"),
							"GFS Didot" => __("GFS Didot","business-responsiveness"),
							"GFS Neohellenic" => __("GFS Neohellenic","business-responsiveness"),
							"Gabriela" => __("Gabriela","business-responsiveness"),
							"Gafata" => __("Gafata","business-responsiveness"),
							"Galdeano" => __("Galdeano","business-responsiveness"),
							"Galindo" => __("Galindo","business-responsiveness"),
							"Gentium Basic" => __("Gentium Basic","business-responsiveness"),
							"Gentium Book Basic" => __("Gentium Book Basic","business-responsiveness"),
							"Geo" => __("Geo","business-responsiveness"),
							"Geostar" => __("Geostar","business-responsiveness"),
							"Geostar Fill" => __("Geostar Fill","business-responsiveness"),
							"Germania One" => __("Germania One","business-responsiveness"),
							"Gilda Display" => __("Gilda Display","business-responsiveness"),
							"Give You Glory" => __("Give You Glory","business-responsiveness"),
							"Glass Antiqua" => __("Glass Antiqua","business-responsiveness"),
							"Glegoo" => __("Glegoo","business-responsiveness"),
							"Gloria Hallelujah" => __("Gloria Hallelujah","business-responsiveness"),
							"Goblin One" => __("Goblin One","business-responsiveness"),
							"Gochi Hand" => __("Gochi Hand","business-responsiveness"),
							"Gorditas" => __("Gorditas","business-responsiveness"),
							"Goudy Bookletter 1911" => __("Goudy Bookletter 1911","business-responsiveness"),
							"Graduate" => __("Graduate","business-responsiveness"),
							"Grand Hotel" => __("Grand Hotel","business-responsiveness"),
							"Gravitas One" => __("Gravitas One","business-responsiveness"),
							"Great Vibes" => __("Great Vibes","business-responsiveness"),
							"Griffy" => __("Griffy","business-responsiveness"),
							"Gruppo" => __("Gruppo","business-responsiveness"),
							"Gudea" => __("Gudea","business-responsiveness"),
							"Habibi" => __("Habibi","business-responsiveness"),
							"Hammersmith One" => __("Hammersmith One","business-responsiveness"),
							"Hanalei" => __("Hanalei","business-responsiveness"),
							"Hanalei Fill" => __("Hanalei Fill","business-responsiveness"),
							"Handlee" => __("Handlee","business-responsiveness"),
							"Hanuman" => __("Hanuman","business-responsiveness"),
							"Happy Monkey" => __("Happy Monkey","business-responsiveness"),
							"Headland One" => __("Headland One","business-responsiveness"),
							"Henny Penny" => __("Henny Penny","business-responsiveness"),
							"Herr Von Muellerhoff" => __("Herr Von Muellerhoff","business-responsiveness"),
							"Holtwood One SC" => __("Holtwood One SC","business-responsiveness"),
							"Homemade Apple" => __("Homemade Apple","business-responsiveness"),
							"Homenaje" => __("Homenaje","business-responsiveness"),
							"IM Fell DW Pica" => __("IM Fell DW Pica","business-responsiveness"),
							"IM Fell DW Pica SC" => __("IM Fell DW Pica SC","business-responsiveness"),
							"IM Fell Double Pica" => __("IM Fell Double Pica","business-responsiveness"),
							"IM Fell Double Pica SC" => __("IM Fell Double Pica SC","business-responsiveness"),
							"IM Fell English" => __("IM Fell English","business-responsiveness"),
							"IM Fell English SC" => __("IM Fell English SC","business-responsiveness"),
							"IM Fell French Canon" => __("IM Fell French Canon","business-responsiveness"),
							"IM Fell French Canon SC" => __("IM Fell French Canon SC","business-responsiveness"),
							"IM Fell Great Primer" => __("IM Fell Great Primer","business-responsiveness"),
							"IM Fell Great Primer SC" => __("IM Fell Great Primer SC","business-responsiveness"),
							"Iceberg" => __("Iceberg","business-responsiveness"),
							"Iceland" => __("Iceland","business-responsiveness"),
							"Imprima" => __("Imprima","business-responsiveness"),
							"Inconsolata" => __("Inconsolata","business-responsiveness"),
							"Inder" => __("Inder","business-responsiveness"),
							"Indie Flower" => __("Indie Flower","business-responsiveness"),
							"Inika" => __("Inika","business-responsiveness"),
							"Irish Grover" => __("Irish Grover","business-responsiveness"),
							"Istok Web" => __("Istok Web","business-responsiveness"),
							"Italiana" => __("Italiana","business-responsiveness"),
							"Italianno" => __("Italianno","business-responsiveness"),
							"Jacques Francois" => __("Jacques Francois","business-responsiveness"),
							"Jacques Francois Shadow" => __("Jacques Francois Shadow","business-responsiveness"),
							"Jim Nightshade" => __("Jim Nightshade","business-responsiveness"),
							"Jockey One" => __("Jockey One","business-responsiveness"),
							"Jolly Lodger" => __("Jolly Lodger","business-responsiveness"),
							"Josefin Sans" => __("Josefin Sans","business-responsiveness"),
							"Josefin Slab" => __("Josefin Slab","business-responsiveness"),
							"Joti One" => __("Joti One","business-responsiveness"),
							"Judson" => __("Judson","business-responsiveness"),
							"Julee" => __("Julee","business-responsiveness"),
							"Julius Sans One" => __("Julius Sans One","business-responsiveness"),
							"Junge" => __("Junge","business-responsiveness"),
							"Jura" => __("Jura","business-responsiveness"),
							"Just Another Hand" => __("Just Another Hand","business-responsiveness"),
							"Just Me Again Down Here" => __("Just Me Again Down Here","business-responsiveness"),
							"Kameron" => __("Kameron","business-responsiveness"),
							"Karla" => __("Karla","business-responsiveness"),
							"Kaushan Script" => __("Kaushan Script","business-responsiveness"),
							"Kavoon" => __("Kavoon","business-responsiveness"),
							"Keania One" => __("Keania One","business-responsiveness"),
							"Kelly Slab" => __("Kelly Slab","business-responsiveness"),
							"Kenia" => __("Kenia","business-responsiveness"),
							"Khmer" => __("Khmer","business-responsiveness"),
							"Kite One" => __("Kite One","business-responsiveness"),
							"Knewave" => __("Knewave","business-responsiveness"),
							"Kotta One" => __("Kotta One","business-responsiveness"),
							"Koulen" => __("Koulen","business-responsiveness"),
							"Kranky" => __("Kranky","business-responsiveness"),
							"Kreon" => __("Kreon","business-responsiveness"),
							"Kristi" => __("Kristi","business-responsiveness"),
							"Krona One" => __("Krona One","business-responsiveness"),
							"La Belle Aurore" => __("La Belle Aurore","business-responsiveness"),
							"Lancelot" => __("Lancelot","business-responsiveness"),
							"Lato" => __("Lato","business-responsiveness"),
							"League Script" => __("League Script","business-responsiveness"),
							"Leckerli One" => __("Leckerli One","business-responsiveness"),
							"Ledger" => __("Ledger","business-responsiveness"),
							"Lekton" => __("Lekton","business-responsiveness"),
							"Lemon" => __("Lemon","business-responsiveness"),
							"Libre Baskerville" => __("Libre Baskerville","business-responsiveness"),
							"Life Savers" => __("Life Savers","business-responsiveness"),
							"Lilita One" => __("Lilita One","business-responsiveness"),
							"Limelight" => __("Limelight","business-responsiveness"),
							"Linden Hill" => __("Linden Hill","business-responsiveness"),
							"Lobster" => __("Lobster","business-responsiveness"),
							"Lobster Two" => __("Lobster Two","business-responsiveness"),
							"Londrina Outline" => __("Londrina Outline","business-responsiveness"),
							"Londrina Shadow" => __("Londrina Shadow","business-responsiveness"),
							"Londrina Sketch" => __("Londrina Sketch","business-responsiveness"),
							"Londrina Solid" => __("Londrina Solid","business-responsiveness"),
							"Lora" => __("Lora","business-responsiveness"),
							"Love Ya Like A Sister" => __("Love Ya Like A Sister","business-responsiveness"),
							"Loved by the King" => __("Loved by the King","business-responsiveness"),
							"Lovers Quarrel" => __("Lovers Quarrel","business-responsiveness"),
							"Luckiest Guy" => __("Luckiest Guy","business-responsiveness"),
							"Lusitana" => __("Lusitana","business-responsiveness"),
							"Lustria" => __("Lustria","business-responsiveness"),
							"Macondo" => __("Macondo","business-responsiveness"),
							"Macondo Swash Caps" => __("Macondo Swash Caps","business-responsiveness"),
							"Magra" => __("Magra","business-responsiveness"),
							"Maiden Orange" => __("Maiden Orange","business-responsiveness"),
							"Mako" => __("Mako","business-responsiveness"),
							"Marcellus" => __("Marcellus","business-responsiveness"),
							"Marcellus SC" => __("Marcellus SC","business-responsiveness"),
							"Marck Script" => __("Marck Script","business-responsiveness"),
							"Margarine" => __("Margarine","business-responsiveness"),
							"Marko One" => __("Marko One","business-responsiveness"),
							"Marmelad" => __("Marmelad","business-responsiveness"),
							"Marvel" => __("Marvel","business-responsiveness"),
							"Mate" => __("Mate","business-responsiveness"),
							"Mate SC" => __("Mate SC","business-responsiveness"),
							"Maven Pro" => __("Maven Pro","business-responsiveness"),
							"McLaren" => __("McLaren","business-responsiveness"),
							"Meddon" => __("Meddon","business-responsiveness"),
							"MedievalSharp" => __("MedievalSharp","business-responsiveness"),
							"Medula One" => __("Medula One","business-responsiveness"),
							"Megrim" => __("Megrim","business-responsiveness"),
							"Meie Script" => __("Meie Script","business-responsiveness"),
							"Merienda" => __("Merienda","business-responsiveness"),
							"Merienda One" => __("Merienda One","business-responsiveness"),
							"Merriweather" => __("Merriweather","business-responsiveness"),
							"Merriweather Sans" => __("Merriweather Sans","business-responsiveness"),
							"Metal" => __("Metal","business-responsiveness"),
							"Metal Mania" => __("Metal Mania","business-responsiveness"),
							"Metamorphous" => __("Metamorphous","business-responsiveness"),
							"Metrophobic" => __("Metrophobic","business-responsiveness"),
							"Michroma" => __("Michroma","business-responsiveness"),
							"Milonga" => __("Milonga","business-responsiveness"),
							"Miltonian" => __("Miltonian","business-responsiveness"),
							"Miltonian Tattoo" => __("Miltonian Tattoo","business-responsiveness"),
							"Miniver" => __("Miniver","business-responsiveness"),
							"Miss Fajardose" => __("Miss Fajardose","business-responsiveness"),
							"Modern Antiqua" => __("Modern Antiqua","business-responsiveness"),
							"Molengo" => __("Molengo","business-responsiveness"),
							"Molle" => __("Molle","business-responsiveness"),
							"Monda" => __("Monda","business-responsiveness"),
							"Monofett" => __("Monofett","business-responsiveness"),
							"Monoton" => __("Monoton","business-responsiveness"),
							"Monsieur La Doulaise" => __("Monsieur La Doulaise","business-responsiveness"),
							"Montaga" => __("Montaga","business-responsiveness"),
							"Montez" => __("Montez","business-responsiveness"),
							"Montserrat" => __("Montserrat","business-responsiveness"),
							"Montserrat Alternates" => __("Montserrat Alternates","business-responsiveness"),
							"Montserrat Subrayada" => __("Montserrat Subrayada","business-responsiveness"),
							"Moul" => __("Moul","business-responsiveness"),
							"Moulpali" => __("Moulpali","business-responsiveness"),
							"Mountains of Christmas" => __("Mountains of Christmas","business-responsiveness"),
							"Mouse Memoirs" => __("Mouse Memoirs","business-responsiveness"),
							"Mr Bedfort" => __("Mr Bedfort","business-responsiveness"),
							"Mr Dafoe" => __("Mr Dafoe","business-responsiveness"),
							"Mr De Haviland" => __("Mr De Haviland","business-responsiveness"),
							"Mrs Saint Delafield" => __("Mrs Saint Delafield","business-responsiveness"),
							"Mrs Sheppards" => __("Mrs Sheppards","business-responsiveness"),
							"Muli" => __("Muli","business-responsiveness"),
							"Mystery Quest" => __("Mystery Quest","business-responsiveness"),
							"Neucha" => __("Neucha","business-responsiveness"),
							"Neuton" => __("Neuton","business-responsiveness"),
							"New Rocker" => __("New Rocker","business-responsiveness"),
							"News Cycle" => __("News Cycle","business-responsiveness"),
							"Niconne" => __("Niconne","business-responsiveness"),
							"Nixie One" => __("Nixie One","business-responsiveness"),
							"Nobile" => __("Nobile","business-responsiveness"),
							"Nokora" => __("Nokora","business-responsiveness"),
							"Norican" => __("Norican","business-responsiveness"),
							"Nosifer" => __("Nosifer","business-responsiveness"),
							"Nothing You Could Do" => __("Nothing You Could Do","business-responsiveness"),
							"Noticia Text" => __("Noticia Text","business-responsiveness"),
							"Nova Cut" => __("Nova Cut","business-responsiveness"),
							"Nova Flat" => __("Nova Flat","business-responsiveness"),
							"Nova Mono" => __("Nova Mono","business-responsiveness"),
							"Nova Oval" => __("Nova Oval","business-responsiveness"),
							"Nova Round" => __("Nova Round","business-responsiveness"),
							"Nova Script" => __("Nova Script","business-responsiveness"),
							"Nova Slim" => __("Nova Slim","business-responsiveness"),
							"Nova Square" => __("Nova Square","business-responsiveness"),
							"Numans" => __("Numans","business-responsiveness"),
							"Nunito" => __("Nunito","business-responsiveness"),
							"Odor Mean Chey" => __("Odor Mean Chey","business-responsiveness"),
							"Offside" => __("Offside","business-responsiveness"),
							"Old Standard TT" => __("Old Standard TT","business-responsiveness"),
							"Oldenburg" => __("Oldenburg","business-responsiveness"),
							"Oleo Script" => __("Oleo Script","business-responsiveness"),
							"Oleo Script Swash Caps" => __("Oleo Script Swash Caps","business-responsiveness"),
							"Open Sans" => __("Open Sans","business-responsiveness"),
							"Open Sans Condensed" => __("Open Sans Condensed","business-responsiveness"),
							"Oranienbaum" => __("Oranienbaum","business-responsiveness"),
							"Orbitron" => __("Orbitron","business-responsiveness"),
							"Oregano" => __("Oregano","business-responsiveness"),
							"Orienta" => __("Orienta","business-responsiveness"),
							"Original Surfer" => __("Original Surfer","business-responsiveness"),
							"Oswald" => __("Oswald","business-responsiveness"),
							"Over the Rainbow" => __("Over the Rainbow","business-responsiveness"),
							"Overlock" => __("Overlock","business-responsiveness"),
							"Overlock SC" => __("Overlock SC","business-responsiveness"),
							"Ovo" => __("Ovo","business-responsiveness"),
							"Oxygen" => __("Oxygen","business-responsiveness"),
							"Oxygen Mono" => __("Oxygen Mono","business-responsiveness"),
							"PT Mono" => __("PT Mono","business-responsiveness"),
							"PT Sans" => __("PT Sans","business-responsiveness"),
							"PT Sans Caption" => __("PT Sans Caption","business-responsiveness"),
							"PT Sans Narrow" => __("PT Sans Narrow","business-responsiveness"),
							"PT Serif" => __("PT Serif","business-responsiveness"),
							"PT Serif Caption" => __("PT Serif Caption","business-responsiveness"),
							"Pacifico" => __("Pacifico","business-responsiveness"),
							"Paprika" => __("Paprika","business-responsiveness"),
							"Parisienne" => __("Parisienne","business-responsiveness"),
							"Passero One" => __("Passero One","business-responsiveness"),
							"Passion One" => __("Passion One","business-responsiveness"),
							"Patrick Hand" => __("Patrick Hand","business-responsiveness"),
							"Patrick Hand SC" => __("Patrick Hand SC","business-responsiveness"),
							"Patua One" => __("Patua One","business-responsiveness"),
							"Paytone One" => __("Paytone One","business-responsiveness"),
							"Peralta" => __("Peralta","business-responsiveness"),
							"Permanent Marker" => __("Permanent Marker","business-responsiveness"),
							"Petit Formal Script" => __("Petit Formal Script","business-responsiveness"),
							"Petrona" => __("Petrona","business-responsiveness"),
							"Philosopher" => __("Philosopher","business-responsiveness"),
							"Piedra" => __("Piedra","business-responsiveness"),
							"Pinyon Script" => __("Pinyon Script","business-responsiveness"),
							"Pirata One" => __("Pirata One","business-responsiveness"),
							"Plaster" => __("Plaster","business-responsiveness"),
							"Play" => __("Play","business-responsiveness"),
							"Playball" => __("Playball","business-responsiveness"),
							"Playfair Display" => __("Playfair Display","business-responsiveness"),
							"Playfair Display SC" => __("Playfair Display SC","business-responsiveness"),
							"Podkova" => __("Podkova","business-responsiveness"),
							"Poiret One" => __("Poiret One","business-responsiveness"),
							"Poller One" => __("Poller One","business-responsiveness"),
							"Poly" => __("Poly","business-responsiveness"),
							"Pompiere" => __("Pompiere","business-responsiveness"),
							"Pontano Sans" => __("Pontano Sans","business-responsiveness"),
							"Port Lligat Sans" => __("Port Lligat Sans","business-responsiveness"),
							"Port Lligat Slab" => __("Port Lligat Slab","business-responsiveness"),
							"Prata" => __("Prata","business-responsiveness"),
							"Preahvihear" => __("Preahvihear","business-responsiveness"),
							"Press Start 2P" => __("Press Start 2P","business-responsiveness"),
							"Princess Sofia" => __("Princess Sofia","business-responsiveness"),
							"Prociono" => __("Prociono","business-responsiveness"),
							"Prosto One" => __("Prosto One","business-responsiveness"),
							"Puritan" => __("Puritan","business-responsiveness"),
							"Purple Purse" => __("Purple Purse","business-responsiveness"),
							"Quando" => __("Quando","business-responsiveness"),
							"Quantico" => __("Quantico","business-responsiveness"),
							"Quattrocento" => __("Quattrocento","business-responsiveness"),
							"Quattrocento Sans" => __("Quattrocento Sans","business-responsiveness"),
							"Questrial" => __("Questrial","business-responsiveness"),
							"Quicksand" => __("Quicksand","business-responsiveness"),
							"Quintessential" => __("Quintessential","business-responsiveness"),
							"Qwigley" => __("Qwigley","business-responsiveness"),
							"Racing Sans One" => __("Racing Sans One","business-responsiveness"),
							"Radley" => __("Radley","business-responsiveness"),
							"Raleway" => __("Raleway","business-responsiveness"),
							"Raleway Dots" => __("Raleway Dots","business-responsiveness"),
							"Rambla" => __("Rambla","business-responsiveness"),
							"Rammetto One" => __("Rammetto One","business-responsiveness"),
							"Ranchers" => __("Ranchers","business-responsiveness"),
							"Rancho" => __("Rancho","business-responsiveness"),
							"Rationale" => __("Rationale","business-responsiveness"),
							"Redressed" => __("Redressed","business-responsiveness"),
							"Reenie Beanie" => __("Reenie Beanie","business-responsiveness"),
							"Revalia" => __("Revalia","business-responsiveness"),
							"Ribeye" => __("Ribeye","business-responsiveness"),
							"Ribeye Marrow" => __("Ribeye Marrow","business-responsiveness"),
							"Righteous" => __("Righteous","business-responsiveness"),
							"Risque" => __("Risque","business-responsiveness"),
							"Roboto" => __("Roboto","business-responsiveness"),
							"Roboto Slab" => __("Roboto Slab","business-responsiveness"),
							"Roboto Condensed" => __("Roboto Condensed","business-responsiveness"),
							"Rochester" => __("Rochester","business-responsiveness"),
							"Rock Salt" => __("Rock Salt","business-responsiveness"),
							"Rokkitt" => __("Rokkitt","business-responsiveness"),
							"Romanesco" => __("Romanesco","business-responsiveness"),
							"Ropa Sans" => __("Ropa Sans","business-responsiveness"),
							"Rosario" => __("Rosario","business-responsiveness"),
							"Rosarivo" => __("Rosarivo","business-responsiveness"),
							"Rouge Script" => __("Rouge Script","business-responsiveness"),
							"Ruda" => __("Ruda","business-responsiveness"),
							"Rufina" => __("Rufina","business-responsiveness"),
							"Ruge Boogie" => __("Ruge Boogie","business-responsiveness"),
							"Ruluko" => __("Ruluko","business-responsiveness"),
							"Rum Raisin" => __("Rum Raisin","business-responsiveness"),
							"Ruslan Display" => __("Ruslan Display","business-responsiveness"),
							"Russo One" => __("Russo One","business-responsiveness"),
							"Ruthie" => __("Ruthie","business-responsiveness"),
							"Rye" => __("Rye","business-responsiveness"),
							"Sacramento" => __("Sacramento","business-responsiveness"),
							"Sail" => __("Sail","business-responsiveness"),
							"Salsa" => __("Salsa","business-responsiveness"),
							"Sanchez" => __("Sanchez","business-responsiveness"),
							"Sancreek" => __("Sancreek","business-responsiveness"),
							"Sansita One" => __("Sansita One","business-responsiveness"),
							"Sarina" => __("Sarina","business-responsiveness"),
							"Satisfy" => __("Satisfy","business-responsiveness"),
							"Scada" => __("Scada","business-responsiveness"),
							"Schoolbell" => __("Schoolbell","business-responsiveness"),
							"Seaweed Script" => __("Seaweed Script","business-responsiveness"),
							"Sevillana" => __("Sevillana","business-responsiveness"),
							"Seymour One" => __("Seymour One","business-responsiveness"),
							"Shadows Into Light" => __("Shadows Into Light","business-responsiveness"),
							"Shadows Into Light Two" => __("Shadows Into Light Two","business-responsiveness"),
							"Shanti" => __("Shanti","business-responsiveness"),
							"Share" => __("Share","business-responsiveness"),
							"Share Tech" => __("Share Tech","business-responsiveness"),
							"Share Tech Mono" => __("Share Tech Mono","business-responsiveness"),
							"Shojumaru" => __("Shojumaru","business-responsiveness"),
							"Short Stack" => __("Short Stack","business-responsiveness"),
							"Siemreap" => __("Siemreap","business-responsiveness"),
							"Sigmar One" => __("Sigmar One","business-responsiveness"),
							"Signika" => __("Signika","business-responsiveness"),
							"Signika Negative" => __("Signika Negative","business-responsiveness"),
							"Simonetta" => __("Simonetta","business-responsiveness"),
							"Sintony" => __("Sintony","business-responsiveness"),
							"Sirin Stencil" => __("Sirin Stencil","business-responsiveness"),
							"Six Caps" => __("Six Caps","business-responsiveness"),
							"Skranji" => __("Skranji","business-responsiveness"),
							"Slackey" => __("Slackey","business-responsiveness"),
							"Smokum" => __("Smokum","business-responsiveness"),
							"Smythe" => __("Smythe","business-responsiveness"),
							"Sniglet" => __("Sniglet","business-responsiveness"),
							"Snippet" => __("Snippet","business-responsiveness"),
							"Snowburst One" => __("Snowburst One","business-responsiveness"),
							"Sofadi One" => __("Sofadi One","business-responsiveness"),
							"Sofia" => __("Sofia","business-responsiveness"),
							"Sonsie One" => __("Sonsie One","business-responsiveness"),
							"Sorts Mill Goudy" => __("Sorts Mill Goudy","business-responsiveness"),
							"Source Code Pro" => __("Source Code Pro","business-responsiveness"),
							"Source Sans Pro" => __("Source Sans Pro","business-responsiveness"),
							"Special Elite" => __("Special Elite","business-responsiveness"),
							"Spicy Rice" => __("Spicy Rice","business-responsiveness"),
							"Spinnaker" => __("Spinnaker","business-responsiveness"),
							"Spirax" => __("Spirax","business-responsiveness"),
							"Squada One" => __("Squada One","business-responsiveness"),
							"Stalemate" => __("Stalemate","business-responsiveness"),
							"Stalinist One" => __("Stalinist One","business-responsiveness"),
							"Stardos Stencil" => __("Stardos Stencil","business-responsiveness"),
							"Stint Ultra Condensed" => __("Stint Ultra Condensed","business-responsiveness"),
							"Stint Ultra Expanded" => __("Stint Ultra Expanded","business-responsiveness"),
							"Stoke" => __("Stoke","business-responsiveness"),
							"Strait" => __("Strait","business-responsiveness"),
							"Sue Ellen Francisco" => __("Sue Ellen Francisco","business-responsiveness"),
							"Sunshiney" => __("Sunshiney","business-responsiveness"),
							"Supermercado One" => __("Supermercado One","business-responsiveness"),
							"Suwannaphum" => __("Suwannaphum","business-responsiveness"),
							"Swanky and Moo Moo" => __("Swanky and Moo Moo","business-responsiveness"),
							"Syncopate" => __("Syncopate","business-responsiveness"),
							"Tangerine" => __("Tangerine","business-responsiveness"),
							"Taprom" => __("Taprom","business-responsiveness"),
							"Tauri" => __("Tauri","business-responsiveness"),
							"Telex" => __("Telex","business-responsiveness"),
							"Tenor Sans" => __("Tenor Sans","business-responsiveness"),
							"Text Me One" => __("Text Me One","business-responsiveness"),
							"The Girl Next Door" => __("The Girl Next Door","business-responsiveness"),
							"Tienne" => __("Tienne","business-responsiveness"),
							"Tinos" => __("Tinos","business-responsiveness"),
							"Titan One" => __("Titan One","business-responsiveness"),
							"Titillium Web" => __("Titillium Web","business-responsiveness"),
							"Trade Winds" => __("Trade Winds","business-responsiveness"),
							"Trocchi" => __("Trocchi","business-responsiveness"),
							"Trochut" => __("Trochut","business-responsiveness"),
							"Trykker" => __("Trykker","business-responsiveness"),
							"Tulpen One" => __("Tulpen One","business-responsiveness"),
							"Ubuntu" => __("Ubuntu","business-responsiveness"),
							"Ubuntu Condensed" => __("Ubuntu Condensed","business-responsiveness"),
							"Ubuntu Mono" => __("Ubuntu Mono","business-responsiveness"),
							"Ultra" => __("Ultra","business-responsiveness"),
							"Uncial Antiqua" => __("Uncial Antiqua","business-responsiveness"),
							"Underdog" => __("Underdog","business-responsiveness"),
							"Unica One" => __("Unica One","business-responsiveness"),
							"UnifrakturCook" => __("UnifrakturCook","business-responsiveness"),
							"UnifrakturMaguntia" => __("UnifrakturMaguntia","business-responsiveness"),
							"Unkempt" => __("Unkempt","business-responsiveness"),
							"Unlock" => __("Unlock","business-responsiveness"),
							"Unna" => __("Unna","business-responsiveness"),
							"VT323" => __("VT323","business-responsiveness"),
							"Vampiro One" => __("Vampiro One","business-responsiveness"),
							"Varela" => __("Varela","business-responsiveness"),
							"Varela Round" => __("Varela Round","business-responsiveness"),
							"Vast Shadow" => __("Vast Shadow","business-responsiveness"),
							"Vibur" => __("Vibur","business-responsiveness"),
							"Vidaloka" => __("Vidaloka","business-responsiveness"),
							"Viga" => __("Viga","business-responsiveness"),
							"Voces" => __("Voces","business-responsiveness"),
							"Volkhov" => __("Volkhov","business-responsiveness"),
							"Vollkorn" => __("Vollkorn","business-responsiveness"),
							"Voltaire" => __("Voltaire","business-responsiveness"),
							"Waiting for the Sunrise" => __("Waiting for the Sunrise","business-responsiveness"),
							"Wallpoet" => __("Wallpoet","business-responsiveness"),
							"Walter Turncoat" => __("Walter Turncoat","business-responsiveness"),
							"Warnes" => __("Warnes","business-responsiveness"),
							"Wellfleet" => __("Wellfleet","business-responsiveness"),
							"Wendy One" => __("Wendy One","business-responsiveness"),
							"Wire One" => __("Wire One","business-responsiveness"),
							"Yanone Kaffeesatz" => __("Yanone Kaffeesatz","business-responsiveness"),
							"Yellowtail" => __("Yellowtail","business-responsiveness"),
							"Yeseva One" => __("Yeseva One","business-responsiveness"),
							"Yesteryear" => __("Yesteryear","business-responsiveness"),
							"Zeyada" => __("Zeyada","business-responsiveness"),
							);
	return $font_family;
}
function Business_Responsiveness_font_style(){
	$font_style = array('normal'=>'Normal','italic'=>'Italic');
	return $font_style;
}

/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @return bool
 */
function Business_Responsiveness_is_json( $string ) {
	return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}

/**
 * Businesss a team contents
 */
function Business_Responsiveness_team_content( $Business_Responsiveness_team_content, $is_callback = false ) {

    if ( ! empty( $Business_Responsiveness_team_content ) ) :
        $Business_Responsiveness_team_content = json_decode( $Business_Responsiveness_team_content );

        if ( ! empty( $Business_Responsiveness_team_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $Business_Responsiveness_team_content as $team_item ) :
                $image = ! empty( $team_item->image_url ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $team_item->image_url, 'Team section' ) : '';
                $title = ! empty( $team_item->title ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $team_item->title, 'Team section' ) : '';
                $subtitle = ! empty( $team_item->subtitle ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $team_item->subtitle, 'Team section' ) : '';
                $text = ! empty( $team_item->text ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $team_item->text, 'Team section' ) : '';
                $link = ! empty( $team_item->link ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $team_item->link, 'Team section' ) : '';
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-team-area">
                        <div class="team-thumbnail text-center">
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php
                                if ( ! empty( $link ) ) :
                                    $link_html = '<a href="' . esc_url( $link ) . '"';
                                    if ( function_exists( 'Business_Responsiveness_is_external_url' ) ) {
                                        $link_html .= Business_Responsiveness_is_external_url( $link );
                                    }
                                    $link_html .= '>';
                                    echo wp_kses_post( $link_html );
                                endif;
                                ?>
                                <img class="img"
                                     src="<?php echo esc_url( $image ); ?>"
                                    <?php
                                    if ( ! empty( $title ) ) :
                                        ?>
                                        alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php if ( ! empty( $link ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="team-body">
                            <?php if ( ! empty( $title ) ) : ?>
                                <a class="team-title" href="<?php echo esc_url( $link ); ?>"><h3><?php echo esc_html( $title ); ?></h3></a>
                            <?php endif; ?>

                             <?php if ( ! empty( $subtitle ) ) : ?>
                            <h4 class="team-degignation"><?php echo esc_html( $subtitle ); ?></h4>
                             <?php endif; ?>

                            <div class="entry-content text-center">

                                 <?php if ( ! empty( $text ) ) : ?>
                                <p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
                                 <?php endif; ?>

                                <?php if ( ! empty( $link ) ) : ?>
                                <p class="team-more">
                                    <a class="team-more-link" href="<?php echo esc_url( $link ); ?>"><?php _e('Read More','business-responsiveness') ?></a>
                                </p>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}

function Business_Responsiveness_get_team_default() {
    return apply_filters(
        'Business_Responsiveness_team_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Madison', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Liam', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Emma', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'Founder', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}

/**
 * Businesss a testimonial contents
 */
function Business_Responsiveness_testimonial_content( $Business_Responsiveness_testimonial_content, $is_callback = false ) {

    if ( ! empty( $Business_Responsiveness_testimonial_content ) ) :
        $Business_Responsiveness_testimonial_content = json_decode( $Business_Responsiveness_testimonial_content );
    	
        if ( ! empty( $Business_Responsiveness_testimonial_content ) ) {

            $i = 1;
            echo '<div class="row">';
            foreach ( $Business_Responsiveness_testimonial_content as $item ) :



                $image = ! empty( $item->image_url ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $item->image_url, 'Testimonial section' ) : '';
                $title = ! empty( $item->title ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $item->title, 'Testimonial section' ) : '';
                $subtitle = ! empty( $item->subtitle ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $item->subtitle, 'Testimonial section' ) : '';
                $text = ! empty( $item->text ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $item->text, 'Testimonial section' ) : '';
                $link = ! empty( $item->link ) ? apply_filters( 'Business_Responsiveness_translate_single_string', $item->link, 'Testimonial section' ) : '';
                ?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-testimonial-area">

                        <div class="rdn-testimonial-image text-center">
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php
                                if ( ! empty( $link ) ) :
                                    $link_html = '<a href="' . esc_url( $link ) . '"';
                                    if ( function_exists( 'Business_Responsiveness_is_external_url' ) ) {
                                        $link_html .= Business_Responsiveness_is_external_url( $link );
                                    }
                                    $link_html .= '>';
                                    echo wp_kses_post( $link_html );
                                endif;
                                ?>
                                <img
                                     src="<?php echo esc_url( $image ); ?>"
                                    <?php
                                    if ( ! empty( $title ) ) :
                                        ?>
                                        alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
                                <?php if ( ! empty( $link ) ) : ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="testimonial-content">
                            <p>
                                <span class="testimonial-title"><?php echo esc_attr($title); ?> <?php if($subtitle!=''){ echo '( ' . esc_attr($subtitle) . ' )'; }?></span>
                                <?php echo $text; ?>

                                <?php if( !empty($link) ){ ?>
                                <a class="testimonial-more" target="_blank" href="<?php echo esc_url( $link ); ?>"><?php _e('Read More','business-responsiveness'); ?></a>
                                <?php } ?>
                            </p>
                        </div>


                    </div>
                </div>
                <?php
                if ( $i % 3 == 0 ) {
                    echo '</div><!-- /.row -->';
                    echo '<div class="row">';
                }
                $i++;
            endforeach;
            echo '</div>';

        }// End if().
    endif;
}
function Business_Responsiveness_get_testimonial_default() {
    return apply_filters(
        'Business_Responsiveness_testimonial_default_content', json_encode(
            array(
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Jackson', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'Designer', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c56',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530ft',
                                'link' => 'plus.google.com',
                                'icon' => 'fa-google-plus',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'Addison', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'Developer', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c66',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb9160ab484',
                                'link' => 'pinterest.com',
                                'icon' => 'fa-pinterest',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                        )
                    ),
                ),
                array(
                    'image_url'       => get_template_directory_uri() . '/images/team.jpg',
                    'title'           => esc_html__( 'John', 'business-responsiveness' ),
                    'subtitle'        => esc_html__( 'CEO', 'business-responsiveness' ),
                    'text'            => esc_html__( 'Lorem Ipsum has been the industry`s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'business-responsiveness' ),
                    'id'              => 'customizer_repeater_56d7ea7f40c76',
                    'social_repeater' => json_encode(
                        array(
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
                                'link' => 'facebook.com',
                                'icon' => 'fa-facebook',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
                                'link' => 'twitter.com',
                                'icon' => 'fa-twitter',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
                                'link' => 'linkedin.com',
                                'icon' => 'fa-linkedin',
                            ),
                            array(
                                'id'   => 'customizer-repeater-social-repeater-57fb918d65f2x',
                                'link' => 'dribbble.com',
                                'icon' => 'fa-dribbble',
                            ),
                        )
                    ),
                ),

            )
        )
    );
}


/**
 * Businesss a service contents
 */
function Business_Responsiveness_service_content( ) {

		$business_obj = new Business_Responsiveness_settings_array();
		$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() ); 


			$key = array('one','two','three');

            echo '<div class="row">';
            	foreach($key as $val){

            		$icon = $option['service_icon_one'];

            		$pageid = $option['service_content_' . $val];

            		$args = array( 'post_type' => 'page' , 'post__in'=> array( $pageid ) );
					$loop = new WP_Query($args);
					while( $loop->have_posts() ) : $loop->the_post();
            	?>
                <div class="col-md-4 col-sm-6">
                    <div class="rdn-service-area text-center">
	                        <div class="rdn-service-icon-area">
	                            <a class="rdn-service-icon" href="<?php echo esc_url( $link); ?>">
	                            	<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
	                            </a>
	                        </div>	

	                        <?php 

	                        the_title('<h3 class="rdn-service-title">
	                            <a href="'.get_the_permalink().'">','</a>
	                        </h3>');

	                        if( get_the_content() ){ 
	                        	the_content(__('Read More','business-responsiveness'));
	                        } 

	                        ?>                        	                       
	                </div>
                </div>

                <?php
                 endwhile;
                wp_reset_postdata(); 
            	}
            echo '</div>';
}