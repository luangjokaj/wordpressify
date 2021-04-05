<?php get_header(); ?>
<div class="container">
	<?php
	if (have_posts()) :
		while (have_posts()) :
			the_post();
			get_template_part('content', 'page');
		endwhile;
		else :
			get_template_part('content', 'none');
		endif;
		?>
</div>
<?php get_footer(); ?>
