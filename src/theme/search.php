<?php get_header();
	$className = '';
	if (!is_search_has_results()) {
		$className = 'no-result';
	}
?>
<div class="lg:grid grid-cols-3 gap-4">	
	<div class="site-content col-span-2 lg:border-r lg:border-gray-200">
		<h2 class="page-title p-5 lg:p-10 text-5xl border-b font-bold border-gray-200">
			Results
		</h2>
		<div class="inner <?php echo $className ?> p-5 lg:p-10">
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
			<div class="pagination">
				<?php echo paginate_links(); ?>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
