<?php

/**
 * @param $categories	- [[slug, name], [], …] 
 * @param $stories   	- Kirby pages
 */

$n = count($categories);
$half1 = array_slice($categories, 0, round($n/2));
$half2 = array_slice($categories, round($n/2));

function countByCatogory ($allStories, $cat) {
	$f = $allStories->filter(function ($p) use ($cat) {
		return in_array($cat, $p->categories()->split());
	});
	return $f->count();
}
?>

<nav id="menu">
	<div class="hmb">
    <button class="hamburger hamburger--slider" type="button" onclick="a.toggleMenu();">
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>
  </div>
  <div class="rotated font-sans-m color-blue-50" onclick="a.toggleMenu();">Categories</div>
  <div class="content">
  	<header>
  		<p class="font-sans-m color-blue-50">
  			<a onclick="a.reset();">(Title)</a>
  		</p>
			<div class="gradient"></div>
  	</header>
		<div class="categories-container">
			<div class="container-fluid px-0">
				<div class="row">
					<div class="col">
						<!-- <p class="font-sans-m color-blue-50 mb-space">All categories</p> -->
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6">
						<?php foreach ($half1 as $c): 
							$n = countByCatogory($stories, $c["name"]);
							?>
							<p class="font-serif-m">
								<a class="category-link" 
								   onclick="handleNavCategoryClick('<?= $c["slug"] ?>');"
								   data-cat-id="<?= $c["slug"] ?>"
							  ><?= $c["name"] ?><span class="count"><?= $n ?></span></a>
							</p>
						<?php endforeach ?>
						</div>
						<div class="col-xl-6">
						<?php foreach ($half2 as $c): 
							$n = countByCatogory($stories, $c["name"]);
							?>
							<p class="font-serif-m">
								<a class="category-link" 
								   onclick="handleNavCategoryClick('<?= $c["slug"] ?>');"
								   data-cat-id="<?= $c["slug"] ?>"
							  ><?= $c["name"] ?><span class="count"><?= $n ?></span></a>
							</p>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom color-blue-50">
			<p class="my-2 mr-space-2"><a onclick="a.openText('about');" class="hover-blue">About the stories</a></p>
			<p class="my-2 mr-space-2"><a onclick="a.openText('privacy');" class="hover-blue">Privacy policy</a></p>
			<p class="my-2 mr-space-2">Site: 
				<a class="color-blue-50 hover-blue no-u" href="https://twitter.com/fedfragapane" target="_blank">F.&nbsp;Fragapane</a>, 
				<a class="color-blue-50 hover-blue no-u" href="https://alexpiacentini.com" target="_blank">A.&nbsp;Piacentini</a>
			</p>
			<div class="gradient"></div>
		</div>
  </div>
</nav>
