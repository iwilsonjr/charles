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

			<?php 

		//$mypages = get_pages( array( 'child_of' => $post->ID ) ); 

			//print_r($mypages[1]);

			//echo('<ul>');


			//foreach ($mypages as $key=>$wpPostObject) {
				/*echo '<li>'.$wpPostObject->post_name.'</li>';
				echo '<li>'.$wpPostObject->post_title.'</li>';
				echo '<li>'.$wpPostObject->ID.'</li>';*/

				$metadata = get_post_meta($post->ID);
				//print_r($metadata);

				/*echo '<li>'.$metadata['project_url'][0].'</li>';
				echo '<li>'.$metadata['project_summary'][0].'</li>';
				echo '<li>'.$metadata['project_duration_start'][0].'</li>';
				echo '<li>'.$metadata['project_duration_end'][0].'</li>';
				echo '<li>'.$metadata['project_slug'][0].'</li>';*/

				/*$project[$wpPostObject->ID]['url'] = $metadata['project_url'][0];
				$project[$wpPostObject->ID]['summary'] = $metadata['project_summary'][0];
				$project[$wpPostObject->ID]['start'] = $metadata['project_duration_start'][0];
				$project[$wpPostObject->ID]['end'] = $metadata['project_duration_end'][0];
				$project[$wpPostObject->ID]['slug'] = $metadata['project_slug'][0];
				$project[$wpPostObject->ID]['status'] = $metadata['project_status'][0];*/
				/*foreach($metadata as $value) {
					echo '<li>'.$value[0].'</li>';
					/*echo '<li>'.$value->project_summary[0].'</li>';
					echo '<li>'.$value->project_duration_end[0].'</li>';
					echo '<li>'.$value->project_duration_start[0].'</li>';
				}*/
			//}

			?>	

				<div class="porfolioDesc">

					<img class="portfolioImg" src="/wp-content/themes/charles-child/images/content/333-large.png" alt="placeholder" />

					<dl class="portfolioInfo">
						<dt class="hide">Project Information</dt>
						<dd><a href="#"><?php echo $metadata['project_url'][0]; ?></a></dd>
						<dd><?php echo $metadata['project_owner'][0]; ?></dd>
						<dd><?php echo $metadata['project_job_title'][0]; ?></dd>
						<dd class="duration"><?php echo $metadata['project_duration_start'][0]; ?> - <?php echo $metadata['project_duration_end'][0]; ?></dd>

						<?php 
						
						if ($metadata['project_status'][0] == "0") {
							$status = "Offline";
						} else {
							$status = "Online";
						};

						?>

						<dd>Status - <?php echo $status; ?></dd>
					</dl>

				</div>


				<ul class="portfolioNav">

				<?php
				$mypages = get_pages( array( 'child_of' => wp_get_post_parent_id($post->ID) ) ); 

			foreach ($mypages as $key=>$wpPostObject) {
				/*echo '<li>'.$wpPostObject->post_name.'</li>';
				echo '<li>'.$wpPostObject->post_title.'</li>';
				echo '<li>'.$wpPostObject->ID.'</li>';*/

				if ($wpPostObject->ID == $post->ID) {
					$selected = " class=\"selected\"";
				} else {
					$selected = "";
				}

?>
					<!--<li class="selected"><a href="#">The Wilson Project</a></li>-->


					<li<?php echo $selected; ?>><a href="/portfolio/<?php echo $wpPostObject->post_name; ?>/"><?php echo $wpPostObject->post_title; ?></a></li>

<?php

			} ?>
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