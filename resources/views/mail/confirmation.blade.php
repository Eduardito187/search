<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="logo">
                <img src="<?= $base_url; ?>/img/default-user.png" alt="Logo" class="logo-picture" />
            </div>
            <div class="email-content">
                <div class="title"><?= $title; ?></div>
                <div class="message"><?= $description; ?></div>
                <div class="message"><?= $footer_text; ?></div>
            </div>
            <div class="footer">
                Copyright © <?= date("Y"); ?> <a href="<?= $base_url; ?>"><?= $app_name; ?></a>. All Rights Reserved.
            </div>
        </div>
    </body>
</html>