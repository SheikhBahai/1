<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package fabthemes
 */

get_header(); ?>
<div class="col-md-9">

	<h2 class="section-title"> <?php the_archive_title();?> </h2>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="row arc-cover">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-md-6">
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
				</div>
			<?php endwhile; ?>
			<div class="clear"></div>
			<div class="col-md-12">
				<?php kriesi_pagination(); ?>
			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		</div>
		</main><!-- #main -->
	</section><!-- #primary -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
