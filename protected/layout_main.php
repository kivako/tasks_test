<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<a href="/" class="btn btn-primary" role="button">На главную</a>
<?php if(Core\App::$isAdmin) :?>
    <a href="index.php?r=site/logout" class="btn btn-secondary" role="button">Выход[Admin]</a>
<?php else: ?>
    <a href="index.php?r=site/login" class="btn btn-secondary" role="button">Авторизация</a>
<?php endif;?>
<div class="container" style="margin-top: 30px">
    <?= $content?>
</div>

</body>
</html>