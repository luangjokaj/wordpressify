<section class="no-results">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'wordpressify' ); ?></h1>
	<div class="inner-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wordpressify' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wordpressify' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wordpressify' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
</div>
