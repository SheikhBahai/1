<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Business_Responsiveness_Woocommerce_Info extends WP_Customize_Control {
	
	public function enqueue() {
		Business_Responsiveness_Plugin_Install_Helper::instance()->enqueue_scripts();
	}

	public function render_content() {
		if ( class_exists( 'WooCommerce' ) ) {
			printf(
				esc_html__( 'You should be able to see the shop section on your front-page. You can configure settings from %s, in your WordPress dashboard.', 'business-responsiveness' ),
				sprintf( '<b>%s</b>', esc_html__( 'Woocommerce > Settings', 'business-responsiveness' ) )
			);
		} else {
			printf(
				esc_html__( 'To access shop section in front page, you need to install the %s plugin.','business-responsiveness' ),
				esc_html( 'woocommerce' )
			);
			echo $this->create_plugin_install_button('woocommerce');
		}
	}
	public function create_plugin_install_button( $slug ) {
		return Business_Responsiveness_Plugin_Install_Helper::instance()->get_button_html( $slug );
	}
}
