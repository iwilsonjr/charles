<?php
/*
Template Name: Portfolio/Projects
*/
?>

<?php get_header(); ?>

<?php get_template_part('navigation'); ?>

	<!--Content-->
	<main>

		<div class="content" id="content">	
	
		<h1><?php the_title(); ?></h1>
	
	<?php if (have_posts()) {

	 while (have_posts()) : the_post(); ?>
	
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="blkPortfolio project">


				<div class="porfolioDesc">

					<img class="portfolioImg" src="/wp-content/themes/charles-child/images/content/333-large.png" alt="placeholder" />

					<dl class="portfolioInfo">
						<dt class="hide">Project Information</dt>
						<dd><a href="#">https://www.thewilsonproject.com/</a></dd>
						<dd>The Wilson Project (Independent Project)</dd>
						<dd>Creator, Web Designer/Developer, Writer/Editor</dd>
						<dd class="duration">April 2001 - Current</dd>
						<dd>Status - Online</dd>
					</dl>

				</div>

				<ul class="portfolioNav">
					<li class="selected"><a href="#">The Wilson Project</a></li>
					<li><a href="#">YouGo Travel Insurance</a></li>
					<li><a href="#">Project #3</a></li>
					<li><a href="#">Project #4</a></li>
					<li><a href="#">Project #5</a></li>
					<li><a href="#">Project #6</a></li>
				</ul>

            </div>
		
			<?php the_content(); ?>
								
			<p><?php edit_post_link(); ?></p>
			
		</article>
		<!-- /article -->
		
	<?php endwhile; ?>
	
	<?php } else { ?>
	
		<!-- article -->
		<article>
			<div class="blogEntry"> 
				<p><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></p>
			</div>
		</article>
		<!-- /article -->
	
	<?php } ?>
	
	
		</div>
	
	</main>
	<!--Content-->

<?php get_footer(); ?>