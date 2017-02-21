<?php get_header(); ?>

<div id="content" class="col span-8">
	<?php if (have_posts()) : ?>
	
	<div class="col last span-6 nudge-2">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<h2 class="ver small">Archived entries for <?php single_cat_title(); ?></h2>	
	</div>
	
		<?php while (have_posts()) : the_post(); ?>
				
		<div class="post">
			<div class="col span-2">
				<ul class="nav">
					<li class="date"><?php the_time('d.m.Y'); ?></li>
					<li><span class="in">In</span> <?php the_category(', '); ?></li>
					<li class="commentdisplay"><a href="<?php comments_link(); ?>"><?php comments_number('','One comment','% comments'); ?></a></li>
				</ul>
<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f69289744cf505b"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f69289744cf505b"></script>
<!-- AddThis Button END -->
			</div>
			
			<div class="post-content nudge-2">
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php the_content('Continue reading...'); ?>
				
				<?php //Tag Listing
					$tagList = get_the_tags();
					$count=0;
					
					if ($tagList) {
						foreach($tagList as $tag) {
						$count++;
							if (1 == $count) {
								if ($tag->name != "")
					?>								
									<p id="tags" class="singleTags"><strong>Tagged as</strong> <?php the_tags( '', ', ', ''); ?>.</p>						

				<?php											
							};
						};
					};
				?>	
						
			</div>
		</div>
		
		<?php // comments_template(); ?>

		<?php endwhile; ?>
		
		<ul class="navigation">
			<li class="left"><?php next_posts_link('&larr; Older Entries') ?></li>
			<li class="right"><?php previous_posts_link('Newer Entries &rarr;') ?></li>
		</ul>

	<?php else : ?>
	
		<h3>Category Not Found</h3>
		<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>
	
</div>

<hr />

<?php get_sidebar(); ?>

<?php get_footer(); ?>