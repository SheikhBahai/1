<?php 
/**
 * This template for displaying page detail page
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
get_header();
Business_Responsiveness_breadcrumbs();
?>
	<section class="rdn-main-content">
		<div class="container">
			<div class="row">
				
				<div class="col-md-8">
				<?php 
				if( have_posts() ):
					while( have_posts() ): the_post();
						// Include the post content template.
						get_template_part('content','page');
						
						// If comments are open or we have at least one comment
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						
						if ( is_singular( 'attachment' ) ) {
							the_post_navigation( array(
								'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'business-responsiveness' ),
							) );
						} elseif ( is_singular( 'post' ) ) {
							the_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'business-responsiveness' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Next post:', 'business-responsiveness' ) . '</span> ' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'business-responsiveness' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Previous post:', 'business-responsiveness' ) . '</span> ' .
									'<span class="post-title">%title</span>',
							) );
						}
						
					endwhile;
					
				endif;
				?>
				</div>
				
				<?php 
				if( (function_exists('is_cart') && is_cart()) || (function_exists('is_checkout') && is_checkout() ) || (function_exists('is_account_page') && is_account_page()) ) {
					get_sidebar('woocommerce');
				}
				else {
					get_sidebar();
				}
				?>
				
			</div>
		</div>
	</section><!-- .rdn-main-content -->
<?php get_footer(); ?>