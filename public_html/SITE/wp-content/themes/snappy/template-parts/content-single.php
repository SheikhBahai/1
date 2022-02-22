<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Snappy
 * @since 1.0.0
 */

$snappy_default = snappy_get_default_theme_options();
$snappy_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_feature_image', true ) );
$snappy_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_views', true ) );
$snappy_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_read_time', true ) );
$snappy_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_like_dislike', true ) );
$snappy_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_author_box', true ) );
$snappy_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_social_share', true ) );
$snappy_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'snappy_ed_post_reaction', true ) );

if( $snappy_ed_post_views ){ snappy_disable_post_views(); }
if( $snappy_ed_post_read_time ){ snappy_disable_post_read_time(); }
if( $snappy_ed_post_like_dislike ){ snappy_disable_post_like_dislike(); }
if( $snappy_ed_post_author_box ){ snappy_disable_post_author_box(); }
if( $snappy_ed_post_reaction ){ snappy_disable_post_reaction(); }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

	<?php if( has_post_thumbnail() ){
		
		if( is_single() ){

			if( empty( $snappy_ed_feature_image ) ){ ?>

				<div class="post-thumbnail">

					<?php snappy_post_thumbnail(); ?>
						
				</div>

			<?php
			}

		}else{ ?>

			<div class="post-thumbnail">
			
				<?php snappy_post_thumbnail(); ?>

			</div>

		<?php
		}

	}

	if ( is_singular() ) { ?>

		<header class="entry-header entry-header-1">

			<h1 class="entry-title entry-title-large">

	            <?php the_title(); ?>

	        </h1>

		</header>

	<?php }

	if( is_single() && 'post' === get_post_type() ){ ?>

		<div class="entry-meta">

			<?php
			snappy_posted_by();
			snappy_posted_on();
			snappy_entry_footer( $cats = true, $tags = false, $edits = false );
			?>

		</div>

	<?php } ?>
	
	<div class="post-content-wrap <?php if( 'post' != get_post_type() || $snappy_ed_post_social_share || !class_exists( 'Booster_Extension_Class' ) ){ echo 'twp-no-social-share'; } ?>">

		<?php if( is_singular() && empty( $snappy_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

			<div class="post-content-share">
				<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
			</div>

		<?php } ?>

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

			<?php
			if ( is_singular() && 'post' === get_post_type() ){ ?>

				<div class="entry-footer">
                    <div class="entry-meta">
                        <?php snappy_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
                    </div>
				</div>

			<?php } ?>

		</div>

	</div>

</article>