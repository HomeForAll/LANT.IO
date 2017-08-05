<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Dark</title>
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/fonts.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/header/header.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/left_bar/left_bar.min.css">
    <link rel="stylesheet" href="/template/html/my_profile_dark/content/my_profile_dark.min.css">
</head>
<body>
<div class="content">
    <div class="left-bar-and-user-profile">
        <?php include_once ROOT_DIR . '/template/html/edit_profile_dark/left_bar/left_bar.php' ?>
        <?php include_once ROOT_DIR . '/template/html/my_profile_dark/content/my_profile_dark.php' ?>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/template/html/my_profile_dark/main.min.js"></script>
<script src="/template/html/edit_profile_dark/header/main.min.js"></script>
</body>
</html>