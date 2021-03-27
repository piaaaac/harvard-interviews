<?php

return [

	"debug" => true,

	"routes" => [

    [ "pattern" => "/about",
      "action"  => function () { return go("/home"); } ],

    [ "pattern" => "/stories",
      "action"  => function () { return go("/home"); } ],

    [ "pattern" => "/stories/(:all)",
      "action"  => function () { return go("/home"); } ],

    [ "pattern" => "/privacy",
      "action"  => function () { return go("/home"); } ],
	],
];