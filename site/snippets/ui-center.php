<?php

/**
 * @param $categories	- [[slug, name], [], …] 
 * @param $stories   	- Kirby pages
 */

?>

<div id="ui-center">
	<header>
		<span class="color-black-30">
			Select the categories on the left or&nbsp;click on&nbsp;the&nbsp;wheel to&nbsp;read&nbsp;the&nbsp;stories. Please click&nbsp;<a href="https://docs.google.com/forms/d/e/1FAIpQLSdmZDporYcBNMS6AqcH0X57Q2ECUJrGACGY5Y-a2cdOPSt-nA/viewform?gxids=7628" target="_blank" class="color-black no-u">here</a> to&nbsp;add your&nbsp;own&nbsp;story.
		</span>
	</header>
	<div id="wheel-wrapper">
		<?php snippet("wheel") ?>
		<div id="wheel-center">
			<h1 id="wheel-title" class="font-serif-huge">Food<br />Stories</h1>
		</div>
		<div id="pagination">
			<a class="prev" onclick="a.prevPage();">&larr;&nbsp;</a>
			<span class="page-num">Stories 1&mdash;50</span>
			<a class="next" onclick="a.nextPage();">&nbsp;&rarr;</a>
		</div>
	</div>
	<div class="bottom">
		<span class="color-black-30">
			Project by the <a class="color-black" onclick="a.openText('about');">Scottish Food Coalition</a>
		</span>
	</div>
</div>
