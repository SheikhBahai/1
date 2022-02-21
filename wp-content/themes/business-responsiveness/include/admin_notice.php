<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Business_Responsiveness_notice_bord {

    function __construct(){
        add_action( 'admin_notices', array( &$this,'Business_Responsiveness_review_notice') );
        add_action( 'wp_ajax_Business_Responsiveness_dismiss_review', array(&$this,'Business_Responsiveness_dismiss_review') );
    }

    public function Business_Responsiveness_review_notice(){
        $review = get_option( 'Business_Responsiveness_review_data' );

        $time	= time();
        $load	= false;

        if ( ! $review ) {
            $review = array(
                'time' 		=> $time,
                'dismissed' => false
            );
            add_option('Business_Responsiveness_review_data', $review);
        } else {
            if ( (isset( $review['dismissed'] ) && ! $review['dismissed']) && (isset( $review['time'] ) && (($review['time'] + (DAY_IN_SECONDS * 4)) <= $time)) ) {
                $load = true;
            }
        }
        if ( ! $load ) {
            return;
        }
        ?>
        <div class="notice notice-success is-dismissible notice-box">

            <p style="font-size:16px;">'<?php _e( 'Hi !, We saw you have been using', 'business-responsiveness' ); ?> <strong><?php _e( 'Business Responsive Pro Theme', 'business-responsiveness' ); ?></strong> <?php _e( 'from a few days and wanted to ask for your help to', 'business-responsiveness' ); ?> <strong><?php _e( 'make the theme better', 'business-responsiveness' ); ?></strong><?php _e( '.We just need a minute of your time to rate the theme. Thank you!', 'business-responsiveness' ); ?></p>
            <p style="font-size:16px;"><strong><?php _e( '~ bangalorethemes', 'business-responsiveness' ); ?></strong></p>
            <p style="font-size:17px;">
                <a style="text-decoration: none;color: #fff;background: #ef4238;padding: 7px 10px; border-radius: 4px;" href="<?php echo esc_url('https://wordpress.org/support/theme/business-a/reviews/?filter=5');  ?>" class="business-responsive-dismiss-review-notice review-out" target="_blank" rel="noopener"><?php _e('Rate the theme','business-responsiveness') ?></a>&nbsp; &nbsp;
                <a style="text-decoration: none;color: #fff;background: #27d63c;padding: 7px 10px; border-radius: 4px;" href="#"  class="business-responsive-dismiss-review-notice rate-later" target="_self" rel="noopener"><?php _e( 'Nope, maybe later', 'business-responsiveness' ); ?></a>&nbsp; &nbsp;
                <a style="text-decoration: none;color: #fff;background: #31a3dd;padding: 7px 10px; border-radius: 4px;" href="#" class="business-responsive-dismiss-review-notice already-rated" target="_self" rel="noopener"><?php _e( 'I already did', 'business-responsiveness' ); ?></a>
            </p>
        </div>
        <script type="text/javascript">
            jQuery(function($){
                jQuery(document).on("click",'.business-responsive-dismiss-review-notice',function(){
                    if ( $(this).hasClass('review-out') ) {
                        var Business_Responsiveness_rate_data_val = "1";
                    }
                    if ( $(this).hasClass('rate-later') ) {
                        var Business_Responsiveness_rate_data_val =  "2";
                        event.preventDefault();
                    }
                    if ( $(this).hasClass('already-rated') ) {
                        var Business_Responsiveness_rate_data_val =  "3";
                        event.preventDefault();
                    }

                    $.post( ajaxurl, {
                        action: 'Business_Responsiveness_dismiss_review',
                        Business_Responsiveness_rate : Business_Responsiveness_rate_data_val
                    });

                    $('.notice-box').hide();
                });
            });
        </script>
        <?php
    }

    public function Business_Responsiveness_dismiss_review(){
        if ( ! $review ) {
            $review = array();
        }
        if($_POST['Business_Responsiveness_rate']=="1"){
            $review['time'] 	 = time();
            $review['dismissed'] = true;

        }
        if($_POST['Business_Responsiveness_rate']=="2"){
            $review['time'] 	 = time();
            $review['dismissed'] = false;

        }
        if($_POST['Business_Responsiveness_rate']=="3"){
            $review['time'] 	 = time();
            $review['dismissed'] = true;

        }
        update_option( 'Business_Responsiveness_review_data', $review );
        die;
    }
}