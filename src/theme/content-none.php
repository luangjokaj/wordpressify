<section class="no-results">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'lk-wordpress-theme' ); ?></h1>
	<img src="<?php echo get_template_directory_uri(); ?>/img/sad.svg" alt="Nothing Found 😔" class="sad-icon">
	<div class="page-content">

		<?php if (is_home() && current_user_can( 'publish_posts' )) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lk-wordpress-theme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif (is_search()) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lk-wordpress-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lk-wordpress-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div>
</section>
</div>
