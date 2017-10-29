<article class="page <?php if (is_checkout() || is_cart()) { echo 'cart checkout fixed'; }; if (is_cart() && WC()->cart->cart_contents_count == 0) { echo ' empty-cart'; }; if (is_account_page()) { echo ' account-page'; }; ?>">
	<?php if (!is_account_page()) : ?>
	<h2 class="single-title"><?php the_title(); ?></h2>
	<?php endif; ?>

	<?php the_content(); ?>

</article>