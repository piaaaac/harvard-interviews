<?php

return function () {
	$cs = page('stories')->children()->listed()->pluck("categories", ",", true);
	$categories = array_map(function ($c) {
		$category = [
			"slug" => Str::slug($c),
			"name" => $c,
		];
		return $category;
	}, $cs);
	usort($categories, function ($a, $b) {
    return strcmp($a["slug"], $b["slug"]);
	});

	$stories = page('stories')->children()->listed()->sortBy('storyDate', 'desc');
	$storiesData = [];

	foreach ($stories->toArray() as $s) {
		$cs = Str::split($s["content"]["categories"], ", ");
		$csSlugs = [];
		foreach ($cs as $c) {
			$csSlugs[] = Str::slug($c);
		}
		$storyData = [
			"slug" 						=> $s["slug"],
			"title"     			=> $s["content"]["title"],
			"text"      			=> $s["content"]["text"],
			"categories"			=> $cs,
			"categoriesSlugs"	=> $csSlugs,
			"storyDate" 			=> $s["content"]["storydate"],
			"author"    			=> $s["content"]["author"],
			"source"    			=> $s["content"]["source"],
			"place"     			=> $s["content"]["place"] ?? "",
		];
		$storiesData[] = $storyData;
	}

	// header('Content-Type: application/json');
	// echo json_encode($storiesData);
	// exit();

	return [
		"categories" 	=> $categories,
		"stories"    	=> $stories,
		"storiesData"	=> $storiesData,
	];
};