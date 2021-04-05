<?php get_header();
	$className = '';
	if (!is_search_has_results()) {
		$className = 'no-result';
	}
?>
<div class="container">
	<div class="row gutter-medium">
		<div class="col-xs-12 col-lg-9 main-content">
			<article class="page-wrapper">
				<?php if (have_posts()) : ?>
				<h1 class="page-title">
				<?php
					if (is_category()) {
						single_cat_title();
					} elseif (is_tag()) {
						single_tag_title();
					} elseif (is_author()) {
						the_post();
						echo 'Author Archives: ' . get_the_author();
						rewind_posts();
					} elseif (is_day()) {
						echo 'Daily Archives: ' . get_the_date();
					} elseif (is_month()) {
						echo 'Monthly Archives: ' . get_the_date('F Y');
					} elseif (is_year()) {
						echo 'Yearly Archives: ' . get_the_date('Y');
					} else {
						echo 'Archives:';
					}
				?>
				</h1>
				<div class="inner <?php echo $className ?>">
					<?php
					while (have_posts()) :
						the_post();
						get_template_part('content', get_post_format());
						endwhile;
					else : get_template_part('content', 'none'); endif;
					?>
				</div>
				<?php echo paginate_links(); ?>
			</article>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
