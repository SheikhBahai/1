<?php
/**
 * The template for displaying search results pages.
 *
 * @package fabthemes
 */

get_header(); ?>

<div class="col-md-9">
	<h2 class="section-title"> <?php printf( __( 'Search Results for: %s', 'fabthemes' ), '<span>' . get_search_query() . '</span>' ); ?> </h2>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php kriesi_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
