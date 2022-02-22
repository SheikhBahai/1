<?php
/*
 * Business welcome screen page
 */
function Business_Responsiveness_welcome_screen_admin_menu(){
	add_theme_page( __( 'About Business Theme', 'business-responsiveness' ), __( 'About Business Theme', 'business-responsiveness' ), 'activate_plugins', 'theme-welcome-page', 'Business_Responsiveness_welcome_screen_page' );
}
add_action( 'admin_menu', 'Business_Responsiveness_welcome_screen_admin_menu' );

function Business_Responsiveness_welcome_screen_page() {
	global $version;
	$abouttheme = wp_get_theme( get_template() );
	$businessversion = substr( $version, 0, 3 );
	?>
	
	<div class="wrap">
		<div class="business-theme-header text-center">
			<h1>
				<?php _e('Welcome To Our', 'business-responsiveness' ); ?>
				<?php echo esc_attr($abouttheme->display( 'Name' )); ?>
				<?php _e('Theme', 'business-responsiveness' ); ?>
				<?php echo esc_attr($businessversion); ?>
			</h1>
		</div>
	</div>
	
	<div class="wrap business-wrap">
		<div class="business-left-info">
			<div class="business-feaure-image">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
			</div>
			<div class="business-content">
				<?php echo $abouttheme->display( 'Description' ); ?>	
			</div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="wrap business-wrap">
		<hr style="margin:20px 0;">
		<h2><?php _e('Have a problem with our theme?','business-responsiveness' ) ?></h2>
		<p class="business-content"><?php _e('If you any problem regarding our About Theme. please contact us to click on Support button.','business-responsiveness' ) ?></p>
		<a target="_blank"  class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a'); ?>">
			<?php _e('Support','business-responsiveness' ); ?>
		</a>
		
		<hr style="margin:20px 0;">
		<h2><?php _e('If you Love it.','business-responsiveness' ) ?></h2>
		<p class="business-content"><?php _e('If you like our About Theme and support kindly share us your feedback to click on Feedback button.','business-responsiveness' ) ?></p>
		<a target="_blank"  class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a/reviews/'); ?>">
			<?php _e('Feedback','business-responsiveness' ); ?>
		</a>
	</div>
	
	<div class="wrap business-wrap text-center">
		<hr style="margin:20px 0;">
		<h2><?php _e('Compaire Our Free and Premium Theme Version','business-responsiveness' ) ?></h2>
		
		<table class="business-table">
			<tbody>
				<tr>
					<th> <?php _e('Features','business-responsiveness' ) ?> </th>
					<th> <?php _e('Free Theme','business-responsiveness' ) ?> </th>
					<th> <?php _e('Premium Theme','business-responsiveness' ) ?> </th>
				</tr>
				<tr>
					<td> <?php _e('Color Scheme','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Front Page','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('About Template','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Contact Template','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Social Icons','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Blog Templates','business-responsiveness' ) ?> </td>
					<td class="text-center"> <?php _e('Defalut','business-responsiveness' ) ?> </td>
					<td class="text-center"> <?php _e('5 Templates','business-responsiveness' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Google Fonts','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <?php _e('500+ Fonts','business-responsiveness' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Responsive Design','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Gallery Template','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('WooCommerce','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Parallax Template','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Google map','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Custom Widgets','business-responsiveness' ) ?> </td>
					<td class="text-center"> <?php _e('2','business-responsiveness' ) ?> </td>
					<td class="text-center"> <?php _e('3','business-responsiveness' ) ?> </td>
				</tr>
				<tr>
					<td> <?php _e('Custom Post Type','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
				<tr>
					<td> <?php _e('Pricing Table','business-responsiveness' ) ?> </td>
					<td class="text-center"> <i class="cross_red"></i> </td>
					<td class="text-center"> <i class="yes_green"></i> </td>
				</tr>
		</tbody>
	</table>
		
	</div>
	
	<div class="wrap business-wrap text-center">
		<hr style="margin:20px 0;">
		<h2><?php _e('Get More Features of About Theme','business-responsiveness' ) ?></h2>
		
		<a class="business-button red" target="_blank" href="<?php echo esc_url('http://bangalorethemes.com/themes/business-responsive/'); ?>"><span><?php _e('Upgrade To Pro','business-responsiveness' ) ?></span></a>
	</div>
	<?php
}