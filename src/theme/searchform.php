<form 
	class="search-form"
	role="search"
	method="get"
	id="searchform"
	action="<?php echo home_url('/'); ?>"
>
	<div class="flex">
		<input
			type="text"
			value=""
			name="s"
			id="s"
			placeholder="Search"
		/>
		<span class="space size-16 horizontal"></span>
		<input type="submit" id="searchsubmit" value="Search" class="button secondary" />
	</div>
</form>
