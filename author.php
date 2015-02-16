<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header('author'); ?>
<?php 
    $author = get_user_by('id', get_query_var('author')); 
    $bio = get_the_author_meta('description', get_query_var('author'));
?>
<div class="author-info">
	<a class="author-avatar" title="<?php echo exa_properize($author->display_name); ?> Profile" href="<?php echo get_bloginfo('url'); ?>/author/<?php echo $author->user_login; ?>">
        <?php $avatar_src = get_wp_user_avatar_src(get_the_author_meta('ID', get_query_var('author')), 'original');
            $avatar_crop = hrld_resize(null, $avatar_src, 200, 200, true);
        ?>
        <img src="<?php echo $avatar_crop['url']; ?>" alt="<?php echo $author->display_name;?>" width="<?php echo $avatar_crop['width'];?>" height="<?php echo $avatar_crop['height'];?>" />
        <?php //echo get_wp_user_avatar($author->ID, 'small-thumbnail')?>
    </a>
    <h1 class="author-title"><?php printf( __( '%s', 'twentythirteen' ), $author->display_name ); ?></h1>
    <h3 class="author-position"><?php echo (hrld_author_has('hrld_current_position', $author->ID) ? get_hrld_author('hrld_current_position', $author->ID):'The Badger Herald'); ?></h3>
    <a href="https://twitter.com/<?php hrld_author('hrld_twitter_handle', $author->ID); ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php hrld_author('hrld_twitter_handle', $author->ID); ?></a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<div class="author-detail">
            <?php if(hrld_author_has('hrld_staff_description', $author->ID)){ ?><span class="author-description"><?php hrld_author('hrld_staff_description', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_extension', $author->ID)){ ?><span class="author-extension">Extension <?php hrld_author('hrld_staff_extension', $author->ID); ?></span><?php } ?>
            <?php if(hrld_author_has('hrld_staff_semesters', $author->ID)){ ?><span class="author-semesters"><?php hrld_author('hrld_staff_semesters', $author->ID); if(get_hrld_author('hrld_staff_semesters', $author->ID) == 1) echo ' semester'; else echo ' semesters';?>  at The Badger Herald.</span><?php } ?>
            <?php if($bio != '') echo '<span class=author-bio>'.$bio.'</span>'; ?>
        </div>
</div>
	
<div id="stream" class="author-stream">

	<?php
	if (!is_paged()) :
		$best_posts = get_the_author_meta( '_hrld_staff_best_posts', get_the_author_meta('ID', get_query_var('author')) );
		if(!empty($best_posts)):
	?>
	<div class="pinned-posts">
		<?php
			$args = array(
				'post__in' => $best_posts,
				'post_type' => 'any',
				'post_status' => array('publish', 'inherit'),
				'posts_per_page' => 2,
			);
			$query = new WP_Query( $args );
    		if ( $query->have_posts() ) : 
    		 /* The loop */ 
				while ( $query->have_posts() ) : $query->the_post();
					if( $post_category != '' && $post_category == ('attachment' || 'featured')) :
						if( exa_is_featured() && $post_category == 'attachment') continue;
						else if( get_post_type()  == 'attachment' && $post_category == 'featured') continue;
					endif;
				?>
				<div class="pinned-post">
				<?php
				get_template_part( 'content', 'pullout-cover' ); 
		?>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif;  ?>
	
	</div>
	<?php 
		else:
			$best_posts = array();
		endif; 
	endif; // End !is_paged()
	?>
		
		<?php
    		if ( have_posts() ) : 
    		 /* The loop */ 
				while ( have_posts() ) : the_post();
				get_template_part( 'content', 'summary-fullstream' ); 
		?>
		<hr />
				<?php endwhile; ?>

				<div class="all-link pagination-link"><?php next_posts_link( 'Older' ); ?></div>
		
		

		<?php 
			endif; 
		?>

</div><!-- id="stream" -->

<?php get_footer(''); ?>