<article class="single">
	<h1 class="single-title"><?php the_title(); ?></h1>

	<p class="post-info">
		<span class="date">
			<?php the_time( 'F j, Y g:i a' ); ?>
		</span>
		<span class="author">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php the_author(); ?>
			</a>
		</span>
		<span class="tags">
			<?php
				$categories = get_the_category();
				$separator  = ', ';
				$output     = '';

			if ( $categories ) {
				foreach ( $categories as $category ) {
					$output .= '<a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a>' . $separator;
				}

				echo trim( $output, $separator );
			}
			?>
		</span>
	</p>

	<?php the_post_thumbnail( 'banner-image' ); ?>

	<div class="post-inner-content">
		<?php the_content(); ?>
	</div>
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</article>
