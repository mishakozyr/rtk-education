<?php

if (isset($_POST['string1']) && isset($_POST['string2'])) {
    $string1 = $_POST['string1'];
    $string2 = $_POST['string2'];

    $count = substr_count($string1, $string2);

    echo "Число вхождений строки \"$string2\" в строку \"$string1\": $count";
} else {
    echo "<span class='error-message'>Ошибка: Необходимо передать обе строки<span>";
}
