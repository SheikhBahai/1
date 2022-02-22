<?php 
/**
 * This template for displaying sidebar
 *
 * @package WordPress
 * @subpackage business-responsiveness
 * @since Business Responsiveness 1.0.0
 */
?>

<?php if( is_active_sidebar('sidebar-primary') ): ?>
<div class="col-md-4">
	<?php dynamic_sidebar('sidebar-primary'); ?>
</div>
<?php endif; ?>