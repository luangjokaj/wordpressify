<?php get_header(); ?>
<div class="container">
	<div class="row gutter-medium">
		<div class="col-xs-12 col-lg-9 main-content">
			<div class="page-wrapper">
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
			<?php echo paginate_links(); ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
