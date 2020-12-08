<?php get_header(); ?>
<div class="lg:grid grid-cols-3 gap-4">	
	<div class="site-content col-span-2 md:border-r md:border-gray-200">
		<article class="page">
			<?php if (have_posts()) : ?>
			<h1 class="page-title p-5 md:p-10 text-5xl border-b font-bold border-gray-200">
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
			<div class="inner <?php if (!is_search_has_results()) {
				echo 'no-result';
			}?>">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('content', get_post_format());
					endwhile;
				else : get_template_part('content', 'none'); endif;
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
