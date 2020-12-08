<?php get_header(); ?>
<div class="lg:grid grid-cols-3 gap-4">	
	<div class="site-content col-span-2 md:border-r md:border-gray-200">
		<article class="page">
			<div class="inner p-5 lg:p-10">
				<?php
					if (have_posts()) :
						while (have_posts()) :
							the_post();
							get_template_part('content', get_post_format());
					endwhile;
					else :
						get_template_part('content', 'none');
					endif;
				?>
			</div>
			<div class="pagination side">
				<?php echo paginate_links(); ?>
			</div>
		</article>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
