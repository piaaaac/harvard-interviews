<?php
$url = $site->url();
$urlSocialImg = $kirby->url("assets"). "/images/fs-social.png";
$siteTitle = $site->title();
$title = $site->title();
$desc = "Project by Harvard University";
?>

<!DOCTYPE html><html><head>

  <title><?= $title ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="<?= $desc ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <!-- TWITTER -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@" />
  <meta name="twitter:title" content="<?= $siteTitle ?>" />
  <meta name="twitter:description" content="<?= $desc ?>" />
  <meta name="twitter:image" content="<?= $urlSocialImg ?>" />

  <!-- OG -->
  <meta property="og:url" content="<?= $url ?>" />
  <meta property="og:image" content="<?= $urlSocialImg ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $siteTitle ?>" />
  <meta property="og:description" content="<?= $desc ?>" />

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $kirby->url("assets") ?>/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $kirby->url("assets") ?>/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $kirby->url("assets") ?>/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= $kirby->url("assets") ?>/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?= $kirby->url("assets") ?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!-- Vendor -->
  <script src="<?= $kirby->url('assets') ?>/lib/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <script src="<?= $kirby->url('assets') ?>/lib/lodash-4.17.15/core.min.js"></script>
  <script src="<?= $kirby->url('assets') ?>/lib/handlebars-4.7.6/handlebars.js"></script>
  
  <!-- Style -->
  <link rel="stylesheet" type="text/css" href="<?= $kirby->url("assets") ?>/css/bootstrap-custom.css">
  <link rel="stylesheet" type="text/css" href="<?= $kirby->url("assets") ?>/css/index.css">

</head>
<body>

