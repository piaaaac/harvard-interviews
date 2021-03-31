<?php

/**
 * @param $categories	- [[slug, name], [], …] 
 * @param $stories   	- Kirby pages
 */

?>

<div id="ui-center">
	<header>
		<span class="color-lightblue-30">
			Select the categories on the left or&nbsp;click on&nbsp;the&nbsp;wheel to&nbsp;read&nbsp;the&nbsp;stories.
		</span>
	</header>
	<div id="wheel-wrapper">
		<?php snippet("wheel") ?>
		<div id="wheel-center">
			<h1 id="wheel-title" class="font-serif-huge">(Title<!-- <br />Stories -->)</h1>
		</div>
		<div id="pagination">
			<a class="prev" onclick="a.prevPage();">&larr;&nbsp;</a>
			<span class="page-num">Stories 1&mdash;50</span>
			<a class="next" onclick="a.nextPage();">&nbsp;&rarr;</a>
		</div>
	</div>
	<div class="bottom">
		<span class="color-lightblue-30">
			Project by <a class="color-lightblue" onclick="a.openText('about');">xxxxxxxx</a>
		</span>
	</div>
</div>
