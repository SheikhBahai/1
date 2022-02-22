<?php 
/**
 * This is main content file
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
?>
<article id="<?php the_ID(); ?>" <?php post_class('post'); ?>>
	
	<?php Business_Responsiveness_post_thumbnail(); ?>
	
	<header class="entry-header">
		<?php 	
			if ( is_single() ) :
				the_title('<h2 class="entry-title">', '</h2>' );
			else:
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif; 
			?>
			
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'business-responsiveness' ); ?></span>
			<?php endif; ?>
	</header>
	
	<?php Business_Responsiveness_post_meta(); ?>
	
	<div class="entry-content">
		<?php 
		
			the_content(__('Read More','business-responsiveness' ));
			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'business-responsiveness' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'business-responsiveness' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>

</article>