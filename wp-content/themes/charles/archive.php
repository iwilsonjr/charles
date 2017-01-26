<?php get_header(); ?>
	
	<!--Content-->
	<section role="main">

		<div class="content" id="content">			
	
		<h1 class="ver"><?php _e( 'Archives for', 'html5blank' ); single_month_title(' '); ?></h1>
	
		<?php get_template_part('loop'); ?>
		
		<?php get_template_part('pagination'); ?>
	
		</div>
	
	</section>
	<!--Content-->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>