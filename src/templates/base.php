<!DOCTYPE html>
<html>
    <head>
        <title><?= isset($context["title"]) ? $context["title"]." - " : "" ?>Allegro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $context["metaDescription"] ?? "" ?>">
        <link rel="shortcut icon" type="image/png" href="static/images/favicon.png"/>
        <link rel="stylesheet" href="static/css/style.css" type="text/css" charset="utf-8"/>
        <link rel="stylesheet" href="static/fonts/LeagueSpartanBold/stylesheet.css" type="text/css" charset="utf-8"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;800&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/1384a8b81d.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include $template ?>
    </body>
    <script src="static/js/utils.js"></script>
</html>