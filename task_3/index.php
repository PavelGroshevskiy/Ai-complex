<!DOCTYPE html>
<html lang="ru">
<head>
  <title>HTML-форма</title>
  <meta charset='utf-8' />
</head>
<body>
<?php
$errors = [];
// print_r($_GET);
// print_r($_POST);
// echo "</br>";


if (!empty($_POST)) {

    if (empty($_POST['first_name'] && $_POST['gender'])) {
        $errors[] = 'Текстовое поле "Name" or "Gender" не заполнено' . PHP_EOL;

    }
    if (empty($errors)) {
        switch($_POST['age'])
        {
        case $_POST['age'] >= 1 && $_POST['age'] <= 35 :
            echo 'МолоДежь!';
            break;
        case $_POST['age'] > 35 && $_POST['age'] <= 50:
            echo 'Скуф';
            break;
        case $_POST['age'] > 50 && $_POST['age'] <= 160:
            echo 'СуперСкуф';
            break;
        default:
            echo 'Возрвст некорректен';                   
        }
        exit();
    }
}


if (!empty($errors)) {
    foreach($errors as $err) {
        echo "</br><span style=\"color:red\">$err</span></br>";
    }
    exit();
}

?>
  <form method='post' target="area">
        <input type='text' name='first_name' placeholder="name"
    value='<?php echo htmlspecialchars($_POST['first_name'] ?? '', ENT_QUOTES); ?>' />
    <input type='text' name='gender' placeholder="gender"
    value='<?php echo htmlspecialchars($_POST['gender'] ?? '', ENT_QUOTES); ?>' />
    <input type='number' name='age' placeholder="age" 
    value='<?php echo htmlspecialchars($_POST['age'] ?? '', ENT_QUOTES); ?>' />
    <input type='submit' value='Отправить' />
  </form>
    <p><iframe name="area" width="500" height="200"></iframe></p>
</body>
</html>