<div id="sidebar" class="col last span-4 portfolionav">
	<div class="section">
		<h4 class="ver small">About</h4>
		<p><?php echo get_bloginfo('description'); ?></p>
	</div>
	
	<ul class="widgetized-sidebar">
	<?php if ( !function_exists('dynamic_sidebar')
	        || !dynamic_sidebar() ) : ?>

	<?php endif; ?>
	</ul>
</div>

<hr />

