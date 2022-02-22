<?php
/**
* Sidebar Metabox.
*
* @package Snappy
*/

add_action( 'add_meta_boxes', 'snappy_metabox' );

if( ! function_exists( 'snappy_metabox' ) ):


    function snappy_metabox() {
        
        add_meta_box(
            'twp-custom-metabox',
            esc_html__( 'Single Post Settings', 'snappy' ),
            'snappy_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
    }

endif;

/**
 * Callback function for post option.
*/
if( ! function_exists( 'snappy_post_metafield_callback' ) ):
    
	function snappy_post_metafield_callback() {

		global $post;
        $post_type = get_post_type($post->ID);
		wp_nonce_field( basename( __FILE__ ), 'snappy_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'snappy'); ?>

                        </a>
                    </li>

                    <?php
                    if( class_exists('Booster_Extension_Class') ){ ?>

                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'snappy'); ?>

                            </a>
                        </li>

                    <?php } ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <?php if( $post_type == 'post' ): ?>

                    <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                         <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','snappy'); ?></h3>

                            <?php
                            $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <label><b><?php esc_html_e( 'Navigation Type','snappy' ); ?></b></label>

                                <select name="twp_disable_ajax_load_next_post">

                                    <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','snappy'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','snappy'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'theme-normal-navigation' ){ echo 'selected'; } ?> value="theme-normal-navigation"><?php esc_html_e('Next Previous Navigation','snappy'); ?></option>
                                    <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','snappy'); ?></option>

                                </select>

                            </div>

                        </div>

                    </div>

                <?php endif;

                $snappy_ed_post_views = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_views', true ) );
                $snappy_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_read_time', true ) );
                $snappy_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_like_dislike', true ) );
                $snappy_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_author_box', true ) );
                $snappy_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_social_share', true ) );
                $snappy_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_reaction', true ) );
                $snappy_ed_post_rating = esc_html( get_post_meta( $post->ID, 'snappy_ed_post_rating', true ) ); ?>

                <div id="twp-tab-booster-content" class="metabox-content-wrap">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','snappy'); ?></h3>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-views" name="snappy_ed_post_views" value="1" <?php if( $snappy_ed_post_views ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-views"><?php esc_html_e( 'Disable Post Views','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-read-time" name="snappy_ed_post_read_time" value="1" <?php if( $snappy_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-like-dislike" name="snappy_ed_post_like_dislike" value="1" <?php if( $snappy_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-author-box" name="snappy_ed_post_author_box" value="1" <?php if( $snappy_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-social-share" name="snappy_ed_post_social_share" value="1" <?php if( $snappy_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-reaction" name="snappy_ed_post_reaction" value="1" <?php if( $snappy_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','snappy' ); ?></label>

                        </div>

                        <div class="metabox-opt-wrap twp-checkbox-wrap">

                            <input type="checkbox" id="snappy-ed-post-rating" name="snappy_ed_post_rating" value="1" <?php if( $snappy_ed_post_rating ){ echo "checked='checked'";} ?>/>
                            <label for="snappy-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','snappy' ); ?></label>

                        </div>

                    </div>

                </div>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'snappy_save_post_meta' );

if( ! function_exists( 'snappy_save_post_meta' ) ):

    function snappy_save_post_meta( $post_id ) {

        global $post;

        if ( !isset( $_POST[ 'snappy_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['snappy_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        $twp_disable_ajax_load_next_post_old = sanitize_text_field( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? snappy_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '' ;
        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }

        $snappy_ed_feature_image_old = absint( get_post_meta( $post_id, 'snappy_ed_feature_image', true ) ); 
        $snappy_ed_feature_image_new = isset( $_POST['snappy_ed_feature_image'] ) ? absint( wp_unslash( $_POST['snappy_ed_feature_image'] ) ) : '';

        if ( $snappy_ed_feature_image_new && $snappy_ed_feature_image_new != $snappy_ed_feature_image_old ){

            update_post_meta ( $post_id, 'snappy_ed_feature_image', $snappy_ed_feature_image_new );

        }elseif( '' == $snappy_ed_feature_image_new && $snappy_ed_feature_image_old ) {

            delete_post_meta( $post_id,'snappy_ed_feature_image', $snappy_ed_feature_image_old );

        }

        $snappy_ed_post_views_old = absint( get_post_meta( $post_id, 'snappy_ed_post_views', true ) ); 
        $snappy_ed_post_views_new = isset( $_POST['snappy_ed_post_views'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_views'] ) ) : '';

        if ( $snappy_ed_post_views_new && $snappy_ed_post_views_new != $snappy_ed_post_views_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_views', $snappy_ed_post_views_new );

        }elseif( '' == $snappy_ed_post_views_new && $snappy_ed_post_views_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_views', $snappy_ed_post_views_old );

        }

        $snappy_ed_post_read_time_old = absint( get_post_meta( $post_id, 'snappy_ed_post_read_time', true ) ); 
        $snappy_ed_post_read_time_new = isset( $_POST['snappy_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_read_time'] ) ) : '';

        if ( $snappy_ed_post_read_time_new && $snappy_ed_post_read_time_new != $snappy_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_read_time', $snappy_ed_post_read_time_new );

        }elseif( '' == $snappy_ed_post_read_time_new && $snappy_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_read_time', $snappy_ed_post_read_time_old );

        }

        $snappy_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'snappy_ed_post_like_dislike', true ) ); 
        $snappy_ed_post_like_dislike_new = isset( $_POST['snappy_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_like_dislike'] ) ) : '';

        if ( $snappy_ed_post_like_dislike_new && $snappy_ed_post_like_dislike_new != $snappy_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_like_dislike', $snappy_ed_post_like_dislike_new );

        }elseif( '' == $snappy_ed_post_like_dislike_new && $snappy_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_like_dislike', $snappy_ed_post_like_dislike_old );

        }

        $snappy_ed_post_author_box_old = absint( get_post_meta( $post_id, 'snappy_ed_post_author_box', true ) ); 
        $snappy_ed_post_author_box_new = isset( $_POST['snappy_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_author_box'] ) ) : '';

        if ( $snappy_ed_post_author_box_new && $snappy_ed_post_author_box_new != $snappy_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_author_box', $snappy_ed_post_author_box_new );

        }elseif( '' == $snappy_ed_post_author_box_new && $snappy_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_author_box', $snappy_ed_post_author_box_old );

        }

        $snappy_ed_post_social_share_old = absint( get_post_meta( $post_id, 'snappy_ed_post_social_share', true ) ); 
        $snappy_ed_post_social_share_new = isset( $_POST['snappy_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_social_share'] ) ) : '';

        if ( $snappy_ed_post_social_share_new && $snappy_ed_post_social_share_new != $snappy_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_social_share', $snappy_ed_post_social_share_new );

        }elseif( '' == $snappy_ed_post_social_share_new && $snappy_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_social_share', $snappy_ed_post_social_share_old );

        }

        $snappy_ed_post_reaction_old = absint( get_post_meta( $post_id, 'snappy_ed_post_reaction', true ) ); 
        $snappy_ed_post_reaction_new = isset( $_POST['snappy_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_reaction'] ) ) : '';

        if ( $snappy_ed_post_reaction_new && $snappy_ed_post_reaction_new != $snappy_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_reaction', $snappy_ed_post_reaction_new );

        }elseif( '' == $snappy_ed_post_reaction_new && $snappy_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_reaction', $snappy_ed_post_reaction_old );

        }

        $snappy_ed_post_rating_old = absint( get_post_meta( $post_id, 'snappy_ed_post_rating', true ) ); 
        $snappy_ed_post_rating_new = isset( $_POST['snappy_ed_post_rating'] ) ? absint( wp_unslash( $_POST['snappy_ed_post_rating'] ) ) : '';

        if ( $snappy_ed_post_rating_new && $snappy_ed_post_rating_new != $snappy_ed_post_rating_old ){

            update_post_meta ( $post_id, 'snappy_ed_post_rating', $snappy_ed_post_rating_new );

        }elseif( '' == $snappy_ed_post_rating_new && $snappy_ed_post_rating_old ) {

            delete_post_meta( $post_id,'snappy_ed_post_rating', $snappy_ed_post_rating_old );

        }

    }

endif;   