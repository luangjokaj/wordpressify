<?php get_header(); ?>
<div class="md:grid grid-cols-3 gap-4">	
	<div class="site-content col-span-2 md:border-r md:border-gray-200">
		<div class="page">
			<h2 class="page-title p-5 md:p-10 text-5xl border-b font-bold border-gray-200">Results</h2>
			<div class="inner <?php if ( ! is_search_has_results() ) { echo 'no-result'; }?> p-5 lg:p-10">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;
					else :
						get_template_part( 'content', 'none' );
					endif;
				?>
			</div>
			<div class="pagination">
				<?php echo paginate_links(); ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
