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

			<?php 

		$mypages = get_pages( array( 'child_of' => $post->ID ) ); 

			//print_r($mypages[1]);

			//echo('<ul>');


			foreach ($mypages as $key=>$wpPostObject) {
				/*echo '<li>'.$wpPostObject->post_name.'</li>';
				echo '<li>'.$wpPostObject->post_title.'</li>';
				echo '<li>'.$wpPostObject->ID.'</li>';*/

				$project[$wpPostObject->ID]['name'] = $wpPostObject->post_name;
				$project[$wpPostObject->ID]['title'] = $wpPostObject->post_title;
				$project[$wpPostObject->ID]['id'] = $wpPostObject->ID;	

				$metadata = get_post_meta($wpPostObject->ID);
				//print_r($metadata);

				/*echo '<li>'.$metadata['project_url'][0].'</li>';
				echo '<li>'.$metadata['project_summary'][0].'</li>';
				echo '<li>'.$metadata['project_duration_start'][0].'</li>';
				echo '<li>'.$metadata['project_duration_end'][0].'</li>';
				echo '<li>'.$metadata['project_slug'][0].'</li>';*/

				$project[$wpPostObject->ID]['url'] = $metadata['project_url'][0];
				$project[$wpPostObject->ID]['summary'] = $metadata['project_summary'][0];
				$project[$wpPostObject->ID]['start'] = $metadata['project_duration_start'][0];
				$project[$wpPostObject->ID]['end'] = $metadata['project_duration_end'][0];
				$project[$wpPostObject->ID]['slug'] = $metadata['project_slug'][0];
				$project[$wpPostObject->ID]['status'] = $metadata['project_status'][0];
				/*foreach($metadata as $value) {
					echo '<li>'.$value[0].'</li>';
					/*echo '<li>'.$value->project_summary[0].'</li>';
					echo '<li>'.$value->project_duration_end[0].'</li>';
					echo '<li>'.$value->project_duration_start[0].'</li>';
				}*/
			}

			?>	

                <ul class="portfolioLister">

					<?php
						foreach ($mypages as $key => $value) {
					?>

					<li>
						<a href="/portfolio/<?php echo $project[$value->ID]['name']; ?>/">
						<img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>

						<h2><a href="/portfolio/<?php echo $project[$value->ID]['name']; ?>/"><?php echo $project[$value->ID]['title']; ?></a></h2>

						<p><?php echo $project[$value->ID]['start']; ?> - <?php echo $project[$value->ID]['end']; ?></p>


					<?php
						if ($project[$value->ID]['status'] == "1") {
					?>
						<p><a href="<?php echo $project[$value->ID]['url']; ?>"><?php echo $project[$value->ID]['url']; ?></a></p>
					<?php

						} else {

					?>
						<p>Offline</p>
					<?php
						}

					?>

						<p><?php echo $project[$value->ID]['summary']; ?></p>
					</li>

					<?php
						};
					?>
				</ul>

                <!--<ul class="portfolioLister">
					<li>
						<a href="/portfolio/the-wilson-project/"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="/portfolio/the-wilson-project/">The Wilson Project</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>	
					<li>
						<a href="/portfolio/yougo/"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="/portfolio/yougo/">YouGo Travel Insurance</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a></p>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #3</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a></p>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #4</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a></p>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>	
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #5</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a></p>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus, vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh vel molestie justo sem eu turpis. Aliquam sed efficitur elit, non aliquet nibh.</p>
					</li>
					<li>
						<a href="#"><img src="/wp-content/themes/charles-child/images/content/333-small.png" alt="placeholder" /></a>
						<h2><a href="#">Project #6</a></h2>
						<p>Project Start - Project End</p>
						<p><a href="#">URL</a></p>

						<p>Vestibulum blandit, nisi fringilla venenatis sollicitudin, lectus nulla vehicula purus.</p>
					</li>
				</ul>-->

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