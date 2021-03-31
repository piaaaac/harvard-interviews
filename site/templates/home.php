<?php

/**
 * @param $categories
 * @param $stories
 * @param $storiesData
 */

?>

<?php snippet("header") ?>

<div id="screen">
	
	<?php snippet("nav", ["categories" => $categories, "stories" => $stories]) ?>
	
	<?php snippet("ui-center", ["categories" => $categories, "stories" => $stories]) ?>

	<div id="ui-right"><div class="content"></div></div>

	<div id="texts"><div class="content"></div></div>

	<a id="logo" target="_blank" href="">
		<img src="<?= $kirby->url("assets") ?>/images/logo.png" />
	</a>
</div>

<?php snippet("hb-templates") ?>

<?= js('assets/js/index.js') ?>

<script>
	var a = new App({
		siteUrl: '<?= $site->url() ?>',
		categories: <?= json_encode($categories) ?>,
		allStories: <?= json_encode($storiesData) ?>,
	});
	a.refreshPagination();
</script>

<?php snippet("footer") ?>
