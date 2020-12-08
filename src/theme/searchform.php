<form 
	class="search-form mb-4"
	role="search"
	method="get"
	id="searchform"
	action="<?php echo home_url('/'); ?>"
>
	<div class="inner-content flex">
		<input
			class="outline-none border-2 rounded-lg py-2 px-5 mr-4 border-gray-200"
			type="text"
			value=""
			name="s"
			id="s"
			placeholder="Search"
		/>
		<input type="submit" id="searchsubmit" value="Search" />
	</div>
</form>
