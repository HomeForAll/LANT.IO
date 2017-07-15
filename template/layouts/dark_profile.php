<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Dark Profile</title>
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/header/header.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/left_bar/left_bar.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/user_profile/user_profile.min.css">
    <link rel="stylesheet" href="/template/html/edit_profile_dark/fonts.min.css">
</head>
<body>
<div class="content">
    <?php include_once ROOT_DIR . '/template/html/edit_profile_dark/header/header.php' ?>
    <div class="left-bar-and-user-profile">
        <?php include_once ROOT_DIR . '/template/html/edit_profile_dark/left_bar/left_bar.php' ?>
        <?php include_once ROOT_DIR . '/template/html/edit_profile_dark/user_profile/user_profile.php' ?>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
</body>
</html>