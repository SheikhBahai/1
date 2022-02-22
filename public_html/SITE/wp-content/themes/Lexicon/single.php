<?php
/**
 * The template for displaying all single posts.
 *
 * @package fabthemes
 */

get_header(); ?>
<div class="col-md-9">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="row">
						<div class="col-md-8">
							<h2 class="section-title"> <?php _e( 'Blog Post', 'fabthemes' );?></h2>
							<?php get_template_part( 'content', 'single' ); ?>

							<div id="authorarea">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
								<h3>About <?php echo get_the_author(); ?></h3>
								<div class="authorinfo">
								<?php the_author_meta( 'description' ); ?>
								<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">View all posts by <?php get_the_author(); ?> <span class="meta-nav">&rarr;</span></a>
								</div>
							</div>

						</div>
						<div class="col-md-4">
							<h2 class="section-title"> <?php _e( 'Related Posts', 'fabthemes' );?></h2>
							<?php get_template_part( 'inc/related' ); ?>
						</div>	
					</div>				

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>