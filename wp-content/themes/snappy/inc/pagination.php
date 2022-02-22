<?php
/**
 *
 * Pagination Functions
 *
 * @package True News
 */

if( !function_exists('snappy_archive_pagination_x') ):

	// Archive Page Navigation
	function snappy_archive_pagination_x(){

		// Global Query
	    if( is_front_page() ){

	    	$posts_per_page = absint( get_option('posts_per_page') );
	        $paged_c = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
	        $posts_args = array(
	            'posts_per_page'        => $posts_per_page,
	            'paged'                 => $paged_c,
	        );
	        $posts_qry = new WP_Query( $posts_args );
	        $max = $posts_qry->max_num_pages;

	    }else{
	        global $wp_query;
	        $max = $wp_query->max_num_pages;
	        $paged_c = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	    }

		$snappy_default = snappy_get_default_theme_options();
		$snappy_pagination_layout = esc_html( get_theme_mod( 'snappy_pagination_layout',$snappy_default['snappy_pagination_layout'] ) );
		$snappy_pagination_load_more = esc_html__('Load More Posts','snappy');
		$snappy_pagination_no_more_posts = esc_html__('No More Posts','snappy');

		if( $snappy_pagination_layout == 'next-prev' ){

			if( is_front_page() && is_page() ){

	            $paged_c = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
	            $latest_post_query = new WP_Query( array( 'post_type'=>'post', 'paged'=> $paged_c ) );?>
	            
	            <nav class="navigation posts-navigation" role="navigation" aria-label="Posts">
	                <div class="nav-links">
	                    <div class="nav-previous">
	                    	<?php echo wp_kses_post( get_next_posts_link( esc_html__( 'Older posts', 'snappy' ), $latest_post_query->max_num_pages ) ); ?>
	                    </div>
	                    <div class="nav-next"><?php echo wp_kses_post( get_previous_posts_link( esc_html__( 'Newer posts', 'snappy' ) ) ); ?></div>
	                </div>

	            </nav>
	        <?php

	        }else{

	            the_posts_navigation();

	        }

		}elseif( $snappy_pagination_layout == 'load-more' || $snappy_pagination_layout == 'auto-load' ){ ?>

			<div class="theme-ajax-post-load hide-no-js">

				<div  style="display: none;" class="theme-loaded-content"></div>
				

				<?php if( $max > 1 ){ ?>

					<button class="theme-loading-button theme-loading-style" href="javascript:void(0)">
						<span style="display: none;" class="theme-loading-status"></span>
						<span class="loading-text"><?php echo esc_html( $snappy_pagination_load_more ); ?></span>
					</button>

				<?php }else{ ?>

					<button class="theme-loading-button theme-loading-style theme-no-posts" href="javascript:void(0)">
						<span style="display: none;" class="theme-loading-status"></span>
						<span class="loading-text"><?php echo esc_html( $snappy_pagination_load_more ); ?></span>
					</button>

				<?php } ?>

			</div>

		<?php }else{

			the_posts_pagination();

		}
			
	}

endif;
add_action('snappy_archive_pagination','snappy_archive_pagination_x',20);


add_action('wp_ajax_snappy_single_infinity', 'snappy_single_infinity_callback');
add_action('wp_ajax_nopriv_snappy_single_infinity', 'snappy_single_infinity_callback');

// Recommendec Post Ajax Call Function.
function snappy_single_infinity_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'snappy_ajax_nonce' ) ) {

        $postid = isset( $_POST['postid'] ) ? absint( wp_unslash( $_POST['postid'] ) ) : '' ;
        $post_single_next_posts = new WP_Query( array( 'post_type' => 'post','post_status' => 'publish','posts_per_page' => 1, 'post__in' => array( absint( $postid ) ) ) );

        if ( $post_single_next_posts->have_posts() ) :
            while ( $post_single_next_posts->have_posts() ) :
                $post_single_next_posts->the_post();
                ob_start(); ?>

                <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class('after-load-ajax '.get_the_ID() ); ?>> 

                	<?php if( has_post_thumbnail() ){ ?>

						<div class="post-thumbnail">

							<?php snappy_post_thumbnail(); ?>

						</div>

					<?php } ?>

					<header class="entry-header entry-header-1">

						<h1 class="entry-title entry-title-large">

				            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>

				        </h1>

					</header>

					<div class="entry-meta">

						<?php
						snappy_posted_by();
						snappy_posted_on();
						snappy_entry_footer( $cats = true, $tags = false, $edits = false );
						?>

					</div>
					
					<div class="post-content">

						<div class="entry-content">

							<?php

							the_content( sprintf(
								/* translators: %s: Name of current post. */
								wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'snappy' ), array( 'span' => array( 'class' => array() ) ) ),
								the_title( '<span class="screen-reader-text">"', '"</span>', false )
							) );


							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'snappy' ),
								'after'  => '</div>',
							) ); ?>

						</div>

						<?php if( is_singular() && 'post' === get_post_type() ){ ?>

							<div class="entry-footer">

								<?php snappy_entry_footer( $cats = false, $tags = true, $edits = true ); ?>

							</div>

						<?php } ?>

					</div>

					<?php
					if ( function_exists('has_block') && has_block('gallery', get_the_content()) ) {

				        echo '<div class="footer-galleries">';
				        $post_blocks = parse_blocks( get_the_content() );

				        if( $post_blocks ){

				            foreach( $post_blocks as $post_block ){

				                if( isset( $post_block['blockName'] ) && 
				                    isset( $post_block['innerHTML'] ) && 
				                    $post_block['blockName'] == 'core/gallery' ){

				                    echo wp_kses_post( $post_block['innerHTML'] );

				                }

				            }

				        }

				        echo '</div>';

				    } ?>

				</article>

                <?php
                $next_post_id = '';
                $next_post = get_next_post();

                if( isset( $next_post->ID ) ){ 
                    $next_post_id = $next_post->ID;
                }

                $output['postid'][] = $next_post_id;
                $output['content'][] = ob_get_clean();

            endwhile;

            wp_send_json_success($output);
            wp_reset_postdata();

        endif;

    }

    wp_die();

}
