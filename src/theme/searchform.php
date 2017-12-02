<form class="search-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="inner-content">
		<input type="text" value="" name="s" id="s" placeholder="<?php the_search_query(); ?>" />
		<input type="submit" id="searchsubmit" value="Search" />
	</div>
</form>