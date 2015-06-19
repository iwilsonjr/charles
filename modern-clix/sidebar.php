<div id="sidebar" class="col last span-4">
	<div class="section">
		<h2 class="ver small">About</h2>
		<p><?php echo get_bloginfo('description'); ?></p>
	</div>
	
	<ul class="widgetized-sidebar">
	<?php if ( !function_exists('dynamic_sidebar')
	        || !dynamic_sidebar() ) : ?>

	<?php endif; ?>
	</ul>
</div>

<hr />

