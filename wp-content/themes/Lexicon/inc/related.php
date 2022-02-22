<?php 
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args=array(
	'category__in' => $category_ids,
	'post__not_in' => array($post->ID),
	'posts_per_page'=> 4, // Number of related posts that will be shown.
	'caller_get_posts'=>1
	);
	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) {
		echo '<div id="related_posts"><ul>';
			while( $my_query->have_posts() ) {
			$my_query->the_post(); ?>
			<li>
				<?php 
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 768, 460, true,true,true ); //resize & crop the image
				?>
				<?php if($image) : ?>
					<a href="<?php the_permalink();?>"> <img class="postimg" src="<?php echo $image ?>" alt="<?php the_title(); ?>" /> </a>
				<?php endif; ?>
			<div class="relatedcontent">
				<h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry-meta">
					<span class="posted-on"> <i class="fa fa-clock-o"></i> <?php the_time('F j, Y'); ?></span>
					<span class="comments-link"> <i class="fa fa-comment"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> </span>
				</div><!-- .entry-meta -->				
				
				<?php custom_excerpt(15, '[...]') ?>
			</div>
			</li>
			<?php  }
		echo '</ul></div>';
	}
}
$post = $orig_post;
wp_reset_query(); 
