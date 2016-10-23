<?php
/***
 * @var object $this экземпляр класса /app/core/View
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php $this->title; ?></title>
    <?php
    $this->renderHead();
    ?>
</head>
<body>
<?php $this->renderBody(); ?>
</body>
</html>