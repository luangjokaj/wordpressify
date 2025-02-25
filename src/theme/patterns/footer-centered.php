<?php
/**
 * Title: Centered footer
 * Slug: creativeblocks/footer-centered
 * Categories: footer
 * Block Types: core/template-part/footer
 * Description: Footer with centered site title and tagline.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
	<div class="wp-block-group">
		<!-- wp:site-title {"level":0,"textAlign":"center"} /-->
		<!-- wp:site-tagline {"textAlign":"center"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
	<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
	<!-- /wp:spacer -->

 <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-1"}}}},"fontSize":"small"} -->
	<p class="has-link-color has-text-align-center has-small-font-size">
	<?php printf(esc_html__('Designed with %s', 'creativeblocks'), '<a href="' . esc_url(__('https://wordpressify.co', 'creativeblocks')) . '" rel="nofollow">WordPressify</a>');?>
	</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
