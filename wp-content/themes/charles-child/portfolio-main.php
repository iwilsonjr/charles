<?php
/*
Template Name: Main Portfolio
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
		
			<?php the_content(); ?>
								
			<p><?php edit_post_link(); ?></p>

            <div class="blkPortfolio">

                <ul class="portfolioLister">
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #1</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>	
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #2</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #3</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #4</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>	
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #5</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #6</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus.</p>
					</li>
				</ul>

            </div>
			
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