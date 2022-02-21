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
$image_size = 'large';
global $snappy_order_class_1, $snappy_order_class_2; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-animate'); ?>>
   <div class="column-row">

       <div class="column column-8 column-sm-12  <?php echo esc_attr( $snappy_order_class_1 ); ?>">
           
          <?php
          if ( is_search() || is_archive() || is_front_page()) {

            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); ?>
            <div class="post-thumbnail data-bg data-bg-big twp-ani-control theme-reveal" data-background="<?php echo esc_url($featured_image[0]); ?>">
                <a href="<?php the_permalink(); ?>" class="theme-responsive-image" tabindex="0"></a>
            </div>
          
          <?php
          }else{

            snappy_post_thumbnail($image_size);
           
          } ?>

           <div class="entry-meta entry-meta-vertical">
               <?php snappy_posted_on( $icon = false ); ?>
               <div class="entry-meta-separator"></div>
               <?php snappy_posted_by( $icon = false ); ?>
           </div>
           
       </div>

       <div class="column column-4 column-sm-12 <?php echo esc_attr( $snappy_order_class_2 ); ?>">
          <div class="post-content">
              <div class="entry-meta-top">
                  <div class="entry-meta">
                      <?php snappy_entry_footer($cats = true, $tags = false, $edits = false, $icon = false); ?>
                  </div>
              </div>

              <header class="entry-header">

                  <h2 class="entry-title entry-title-big">

                      <a href="<?php the_permalink(); ?>" rel="bookmark" class="theme-animate-up animate-theme-reveal-up">
                          <span><?php the_title(); ?></span>
                      </a>

                  </h2>

              </header>



            <div class="entry-content">

                <?php
                if( has_excerpt() ){

                    the_excerpt();

                }else{

                    echo '<p>';
                    echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );
                    echo '</p>';
                }

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'snappy' ),
                    'after'  => '</div>',
                ) ); ?>

            </div>

              <a href="<?php the_permalink(); ?>" rel="bookmark"  class="btn-fancy">
                  <span class="btn-arrow"></span>
                  <span class="btn-arrow-text"><?php esc_html_e('Continue Reading','snappy'); ?></span>
              </a>

          </div>
        </div>

   </div>
</article>