<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  action="" method="POST" enctype="multipart/form-data">
        <label>Имя студента: <input type="text" name="name"></label><br>
        <label>Дата рождения студента: <input type="date" name="date"></label><br>
        <label>Курс: <input type="number" name="course"></label><br>
        <label>Любимый цвет: <input type="color" name="color"></label><br>
        <label>Файл: <input type="file" name="file"></label><br>
        <input type="submit" name="send" value="Отправить форму">
    </form>

    <?php

    require_once("Form.php");
    
    $ff = new Form;

    echo $ff->SaveFile();
    echo $ff->DeleteFile();
    echo $ff->DeleteFile();

    ?>
    
</body>
</html>