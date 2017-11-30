<article class="page">
	<?php if (!is_account_page()) : ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php endif; the_content(); ?>
</article>