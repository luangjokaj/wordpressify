<?php
/**
 * Title: Footer with newsletter signup
 * Slug: creativeblocks/footer-newsletter
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Footer with large site title and newsletter signup.
 */
?>
<!-- wp:group {"align":"full","className":"is-style-section-3","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group alignfull is-style-section-3" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"style":{"typography":{"fontSize":"clamp(1rem, 380px, 24vw)","letterSpacing":"-0.02em","fontWeight":"600","fontStyle":"normal"}}} -->
		<h2 class="wp-block-heading" style="font-size:clamp(1rem, 380px, 24vw);font-style:normal;font-weight:600;letter-spacing:-0.02em"><?php esc_html_e('Stories', 'creativeblocks'); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"fontSize":"x-large"} -->
		<p class="has-x-large-font-size"><?php esc_html_e('Receive our articles in your inbox.', 'creativeblocks'); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php esc_html_e('Subscribe', 'creativeblocks'); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:spacer {"height":"var:preset|spacing|50"} -->
		<div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:group {"align":"full","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignfull">
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php esc_html_e('Twenty Twenty-Five', 'creativeblocks'); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-link-color has-small-font-size">
		 <?php printf(esc_html__('Designed with %s', 'creativeblocks'), '<a href="' . esc_url(__('https://wordpressify.co', 'creativeblocks')) . '" rel="nofollow">WordPressify</a>');?>
			</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
