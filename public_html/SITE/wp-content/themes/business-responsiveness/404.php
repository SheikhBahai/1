<?php 
/**
 * This template for displayin Eorro Message
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
get_header();?>
	<section class="rdn-main-content">
		<div class="container">
			<div class="row">
				
				<div class="col-md-8">
						
					<article class="error-404 not-found post">
						
						<header class="page-header">
							<h1 class="page-title"><?php _e('404 Error','business-responsiveness' ); ?></h1>
						</header><!-- .page-header -->
					
						<header class="entry-header">
							<h2 class="entry-title"><?php _e( 'Sorry! This page not founds.', 'business-responsiveness' ); ?></h2>
						</header>
						<div class="entry-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'business-responsiveness' ); ?></p>
							<br>
							<?php get_search_form(); ?>
							<br>
							<br>
						</div>
					</article>
				</div>
				
				<?php get_sidebar(); ?>
				
			</div>
		</div>
	</section><!-- .rdn-main-content -->
<?php get_footer(); ?>