<?php 
/**
 * This is main template file
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
					
					<?php if( have_posts() ): ?>
						<header class="page-header">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
						</header><!-- .page-header -->
					<?php
						while( have_posts() ): the_post();
							get_template_part('content','');
						endwhile;
					else:
						get_template_part('content','none');
					endif;
										
					// Previous/next page navigation.
					the_posts_pagination( array(
					'prev_text'          => __('<<','business-responsiveness' ),
					'next_text'          => __('>>','business-responsiveness' ),
					'type'               => 'list'
					) );
					?>
				</div>
				
				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</section><!-- .rdn-main-content -->
<?php get_footer(); ?>