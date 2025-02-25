<?php
/**
 * Title: Centered footer with social links
 * Slug: creativeblocks/footer-social
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Footer with centered site title and social links.
 */
?>
<!-- wp:group {"align":"full","className":"is-style-section-5","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-section-5" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
	<div class="wp-block-group">
		<!-- wp:site-title {"level":2,"textAlign":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"400"}},"fontSize":"x-large"} /-->
		<!-- wp:navigation {"overlayMenu":"never","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|20"}},"fontSize":"x-large","layout":{"type":"flex","justifyContent":"center"},"ariaLabel":"<?php esc_attr_e('Social media', 'creativeblocks'); ?>"} -->
		<!-- wp:navigation-link {"label":"<?php esc_html_e('Facebook', 'creativeblocks'); ?>","url":"#"} /-->
		<!-- wp:navigation-link {"label":"<?php esc_html_e('Instagram', 'creativeblocks'); ?>","url":"#"} /-->
		<!-- wp:navigation-link {"label":"<?php echo esc_html_x('X', 'Refers to the social media platform formerly known as Twitter.', 'creativeblocks'); ?>","url":"#"} /-->
		<!-- /wp:navigation -->
	</div>
	<!-- /wp:group -->
	<!-- wp:spacer {"height":"var:preset|spacing|30"} -->
	<div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->
 <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-1"}}}},"fontSize":"small"} -->
	<p class="has-link-color has-text-align-center has-small-font-size">
	<?php printf(esc_html__('Designed with %s', 'creativeblocks'), '<a href="' . esc_url(__('https://wordpressify.co', 'creativeblocks')) . '" rel="nofollow">WordPressify</a>');?>
		</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
