<?php get_header(); ?>
<div class="container">
	<div class="site-content single">
		<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post();
				if (get_post_format() == false) {
					get_template_part('content', 'single');
				} else {
					get_template_part('content', get_post_format());
				}
		endwhile;
		else :
			get_template_part('content', 'none');
		endif;
		?>
	</div>
</div>
<?php get_footer(); ?>
