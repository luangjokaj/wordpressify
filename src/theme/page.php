<?php get_header(); ?>
<div class="p-5 lg:p-10">	
	<div class="site-content page">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'content', 'page' );
			endwhile;
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>
	</div>
</div>
<?php get_footer(); ?>
