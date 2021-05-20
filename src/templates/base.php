
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $context["title"] ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $context["metaDescription"] ?? "" ?>">
        <link rel="stylesheet" href="static/css/style.css" type="text/css" charset="utf-8"/>
        <link rel="stylesheet" href="static/fonts/LeagueSpartanBold/stylesheet.css" type="text/css" charset="utf-8"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;800&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include $template ?>
    </body>
</html>
