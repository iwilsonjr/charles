<?php

	//Archive Redirect
	if (isset($_GET['archives']) && ($_GET['archives'] != '')) {

		//If Date Archives from Contextual Navigation - Get Date Archives
		header("Location: " . $_GET['archives']);
		exit();
		
	} else {

		//If Not Archives - Get Header
		get_header(); 

	}

?>
	
	<!--Content-->
	<section role="main">

		<div class="content" id="content">		
	
			<h1 class="hide"><?php _e( 'Latest Blog Entries', 'html5blank' ); ?></h1>
		
			<?php get_template_part('loop'); ?>
			
			<?php get_template_part('pagination'); ?>

		</div>
	
	</section>
	<!--Content-->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>