<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package fabthemes
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="col-md-3">
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php get_template_part( 'sponsors' ); ?>	
</div><!-- #secondary -->
</div>