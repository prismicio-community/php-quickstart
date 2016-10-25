<?php

if (!isset($title)) {
  $title = SITE_TITLE;
}
if (!isset($description)) {
  $description = SITE_DESCRIPTION;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; Charset=UTF-8" http-equiv="Content-Type" />
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description; ?>">
    <link rel="stylesheet" href="/stylesheets/reset.css">
    <link rel="stylesheet" href="/stylesheets/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/punch.png" />
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <? /* Required for previews and experiments */ ?>
    <script>
      window.prismic = {
        endpoint: '<?= PRISMIC_URL ?>'
      };
    </script>
    <script src="//static.cdn.prismic.io/prismic.js"></script>
  </head>
  <body>