<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
</head>
<body>
    head
    <hr>
    <a href="<?php echo BASE_URL?>">Home</a>
    <a href="<?php echo BASE_URL?>article/create">Create</a>
    <hr>
    <?php echo ($content)?>
    <hr>
    footer
</body>
</html>
