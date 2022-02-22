<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package fabthemes
 */

get_header(); ?>
<div class="col-md-6">
	<h2 class="section-title"> <?php _e( 'Latest Posts', 'fabthemes' );?></h2>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php kriesi_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<div class="col-md-3">
	<h2 class="section-title"> <?php _e( 'Featured Posts', 'fabthemes' );?></h2>

		<?php 
			$featcount = ft_of_get_option('fabthemes_featcount','4');
			$featcat = ft_of_get_option('fabthemes_feat_cat','1');
			$args = array( 'posts_per_page' => $featcount, 'cat' => $featcat );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); 
		?>

			<div class="grid-box ">

				<?php 
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 768, 460, true,true,true ); //resize & crop the image
				?>
				<?php if($image) : ?>
					<a href="<?php the_permalink();?>"> <img class="postimg" src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> </a>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<div class="entry-meta">
					<span class="posted-on"> <i class="fa fa-clock-o"></i> <?php the_time('F j, Y'); ?></span>
					<span class="comments-link"> <i class="fa fa-comment"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> </span>
				</div><!-- .entry-meta -->	

				<?php custom_excerpt(25, '[...]') ?>

			</div>


		<?php 
			endwhile;
		    wp_reset_postdata();
		?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
