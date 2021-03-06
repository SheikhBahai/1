<?php
if ( ! class_exists( 'WooCommerce' ) )
	return;

$business_obj = new Business_Responsiveness_settings_array();
$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() ); 

$shop_no_of_show = $option['shop_no_of_show'];
?>

<?php if( $option['shop_section_enable'] == true ) : ?>
	<section id="shop" style="background:url('<?php echo esc_url( $option['shop_section_image'] ); ?>') fixed center <?php echo esc_attr( $option['shop_section_image_repeat'] ); ?> <?php echo esc_attr( $option['shop_section_backgorund_color'] ); ?>;">
		<div class="rdn-section-body">
			<div class="container">
			
				<div class="row">
					<?php if($option['shop_section_title']!=''): ?>
					<h1 class="section-title wow animated fadeInUp"><?php echo wp_kses_post( $option['shop_section_title'] ); ?></h1>
					<?php endif; ?>
					<?php if($option['shop_section_description']!=''): ?>
					<p class="section-desc wow animated fadeInUp"><?php echo wp_kses_post( $option['shop_section_description'] ); ?></p>
					<?php endif; ?>
				</div>
				
				<?php Business_Responsiveness_shop_content( $shop_no_of_show ); ?>
				
			</div>
		</div>
	</section><!-- #rdn-shop -->
<?php endif; ?>