<?php get_header();
	$className = '';
	if (!is_search_has_results()) {
		$className = 'no-result';
	}
?>
<div class="container">
	<div class="row gutter-medium">
		<div class="col-xs-12 col-lg-9 main-content">
			<div class="page-wrapper">
				<h2 class="page-title">
					Results
				</h2>
				<div class="inner <?php echo $className ?>">
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
					<?php echo paginate_links(); ?>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
