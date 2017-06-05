<?php

get_header(); ?>

	<!-- site-content -->
	<div class="site-content clearfix">

		<?php if (have_posts()) :
			while (have_posts()) : the_post();

			get_template_part('content', 'page');

			endwhile;

			else :
				echo '<p>No content found</p>';

			endif;
			?>


	</div><!-- /site-content -->

	<?php get_footer();

?>