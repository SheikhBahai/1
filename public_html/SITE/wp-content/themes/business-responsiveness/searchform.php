<?php
/**
 * Template for displaying search forms
 *
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 * @since 1.1
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'business-responsiveness' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'business-responsiveness' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit"><?php echo _e( 'Search', 'business-responsiveness' ); ?></button>
	</label>
</form>
