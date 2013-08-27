<?php
/**
 *
 * BH Homepage Theme.
 * 
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>
	
	<div id="stream">

	<?php if ( have_posts() ) : ?>

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'summary' ); ?>
		<?php endwhile; ?>

		<?php twentythirteen_paging_nav(); ?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- id="stream" -->

	<?php get_sidebar(); ?>

	<div id="clearfix"></div>


<?php get_footer(); ?>