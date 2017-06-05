<?php

get_header();

if (have_posts()) :
	while (have_posts()) : the_post(); ?>
	
	<article class="post page">
		
		<!-- column-container -->
		<div class="column-container clearfix">
			
			<!-- title-column -->
			<div class="title-column">
				<h2><?php the_title(); ?></h2>
			</div><!-- /title-column -->
			
			<!-- text-column -->
			<div class="text-column">
				<?php the_content(); ?>
			</div><!-- /text-column -->
			
		</div><!-- /column-container -->
		
		
	</article>
	
	<?php endwhile;
	
	else :
		echo '<p>No content found</p>';
	
	endif;
	
get_footer();

?>