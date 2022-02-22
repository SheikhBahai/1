<?php
$business_obj = new Business_Responsiveness_settings_array();
$option = wp_parse_args(  get_option( 'business_r_option', array() ), $business_obj->default_data() );

$class = '';
if($option['service_section_image']!=''){
	$class = 'sectionoverlay';
}

?>
<?php if($option['service_section_enable']==true): ?>
	<section id="service" class="<?php echo esc_attr( $class ); ?>" style="background:url('<?php echo esc_url( $option['service_section_image'] ); ?>') fixed center <?php echo esc_attr( $option['service_section_image_repeat'] ); ?> <?php echo esc_attr( $option['service_section_backgorund_color'] ); ?>;">
		<div class="rdn-section-body">
			<div class="container">
				<div class="row">
					<?php if($option['service_section_title']!=''): ?>
					<h2 class="section-title wow animated fadeInUp"><?php echo wp_kses_post( $option['service_section_title'] ); ?></h2>
					<?php endif; ?>
					<?php if($option['service_section_description']!=''): ?>
					<p class="section-desc wow animated fadeInUp"><?php echo wp_kses_post( $option['service_section_description'] ); ?></p>
					<?php endif; ?>
				</div>

                <?php Business_Responsiveness_service_content();  ?>
				
			</div>
		</div>
	</section><!-- #rdn-services -->
<?php endif; ?>