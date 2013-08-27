<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


$args = array(
	'post_type'=> array('news'),
	'posts_per_page' => 40
);
// The Query
$sidebarquery = new WP_Query( $args );

?>

<div id="sidebar">

<ul class="sidebar-posts">
<?php 
// The Loop
if ( $sidebarquery->have_posts() ) :
	$adcount = 0;
	while ( $sidebarquery->have_posts() ) : 
		$sidebarquery->the_post();

	if($adcount==3) :
		exa_include_sidebar_square_ad();
	endif;
	?>
	
		<li class="post-in-sidebar">
		<?php exa_list_categories(false) ?>
		<a class="post-permalink" href="<?php the_permalink() ?>"><?php the_title() ?></a>

		</li>

<?php 
	$adcount+=1;
	endwhile;
else : 
	echo "No posts yet";
endif; 
/* Restore original Post Data */
wp_reset_postdata();
?>
</ul><!-- class="sidebar-posts" -->


</div>