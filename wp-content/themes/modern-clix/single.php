<?php get_header(); ?>

<div id="content" class="col span-8">
	<?php if (have_posts()) : ?>
	
	<div class="col last span-6 nudge-2">
		<h2 class="ver small">You are reading</h2>	
	</div>
	
		<?php while (have_posts()) : the_post(); ?>
				
		<div class="post">
			<div class="post-meta col span-2">
				<ul class="nav">
					<li class="date"><?php the_time('d.m.Y'); ?></li>
					<li><span class="in">In</span> <?php the_category(', '); ?></li>
					
					<!-- Uncomment this if you want support for tags -->
					<!-- <li>Tagged as <?php the_tags( '', ', ', ''); ?></li> -->
					
					<li class="commentdisplay"><a href="#comments"><?php comments_number('','One comment','% comments'); ?></a></li>
					<?php edit_post_link('Edit this post', '<li>', '</li>'); ?>
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
							}
						}
					}
					?>
				

			</div>
		</div>
		
		<?php comments_template(); ?>

		<?php endwhile; ?>

	<?php else : ?>
	
		<h3 class="notfound">Post Not Found</h3>
		<p>Sorry, but you are looking for something that isn't here.</p>
	
	<?php endif; ?>
	
</div>

<hr />

<?php get_sidebar(); ?>

<?php get_footer(); ?>