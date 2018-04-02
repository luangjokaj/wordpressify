<footer class="footer">
	<section class="categories">
		<ul>
			<?php
				$get_parent_cats = array(
					'parent' => '0', // get top level categories only
				);

				$all_categories = get_categories( $get_parent_cats );// get parent categories

				foreach ( $all_categories as $single_category ) {
					// for each category, get the ID
					$cat_id = $single_category->cat_ID;

					echo '<li data-aos="slow-categories" data-aos-offset="0"><h2>' . $single_category->name . '</h2>'; // category name & link
						echo '<ul class="post-title">';

					$query = new WP_Query(
						array(
							'cat'            => $cat_id,
							'posts_per_page' => -1,
							'order'          => 'ASC',
						)
					);
					while ( $query->have_posts() ) :
						$query->the_post();
						echo '<li data-aos="slow-categories" data-aos-offset="0"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					endwhile;
					wp_reset_postdata();

					echo '</ul>';
					$get_children_cats = array(
						'child_of' => $cat_id, // get children of this parent using the cat_id variable from earlier
					);

					$child_cats = get_categories( $get_children_cats );// get children of parent category
					echo '<ul class="children">';
					foreach ( $child_cats as $child_cat ) {
						// for each child category, get the ID
						$child_id = $child_cat->cat_ID;

						// for each child category, give us the link and name
						echo '<a href=" ' . get_category_link( $child_id ) . ' ">' . $child_cat->name . '</a>';

							echo '<ul class="post-title">';

						$query = new WP_Query(
							array(
								'cat'            => $child_id,
								'posts_per_page' => -1,
								'order'          => 'ASC',
							)
						);
						while ( $query->have_posts() ) :
							$query->the_post();
							echo '<li data-aos="slow-categories" data-aos-offset="0"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
							endwhile;
						wp_reset_postdata();

						echo '</ul>';

					}
					echo '</ul></li>';
				} //end of categories logic
			?>
		</ul>
	</section>

	<section class="riangle">
		<p>
			<span>Powered by <strong><a href="https://www.riangle.com/" target="_blank">Riangle</a></strong>. <?php bloginfo( 'name' ); ?></span> - &copy; <?php echo date( 'Y' ); ?></p>
		</p>
	</section>

</footer>
<?php wp_footer(); ?>
</body>
</html>
