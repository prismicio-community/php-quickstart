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
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description; ?>">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <link href="/stylesheets/reset.css" rel="stylesheet">
        <link href="/stylesheets/style.css" rel="stylesheet">
        <link href="/images/punch.png" rel="icon" type="image/png">
        <? /* Required for previews and experiments */ ?>
        <script>
            window.prismic = {
                endpoint: '<?= PRISMIC_URL ?>'
            };
        </script>
        <script src="https://static.cdn.prismic.io/prismic.js"></script>
    </head>
    <body>
