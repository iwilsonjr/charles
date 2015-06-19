<?php get_header(); ?>
	
	<!--Content-->
	<section role="main">

		<div class="content" id="content">	
	
		<h1><?php the_title(); ?></h1>
	
	<?php if (have_posts()) {

	 while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<?php the_content(); ?>
								
			<p><?php edit_post_link(); ?></p>
			
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php } else { ?>
	
		<!-- article -->
		<article>
			
			<p><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></p>
			
		</article>
		<!-- /article -->
	
	<?php } ?>
	
	
		</div>
	
	</section>
	<!--Content-->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>