<?php 

// 1. Сделайте функцию, которая принимает строку на русском языке, а возвращает ее транслит.
echo "1. ";
function translit_rus_to_eng($text) 
{
    $arr_ru = [
        "а", "б", "в", "г", "д", "е", "ё", "ж", "з", "и", "й", "к", "л", "м", "н", "о", "п", 
        "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ь", "ы", "ъ", "э", "ю", "я"
    ];
    $arr_en = [
        "a", "b", "v", "g", "d", "e", "jo", "zh", "z", "i", "j", "k", "l", "m", "n", "o", "p", 
        "r", "s", "t", "u", "f", "h", "cz", "ch", "sh", "shh", "`", "y", "``", "e`", "yu", "ya"
    ];

    $text = mb_str_split($text);
    $a = "";

    foreach($text as $letter) {
        if($letter == mb_strtolower($letter)) {
            $a .= str_replace($arr_ru, $arr_en, $letter);
        } elseif($letter == mb_strtoupper($letter)) {
            $letter = mb_strtolower($letter);
            $letter1 = str_replace($arr_ru, $arr_en, $letter);
            $letter1 = mb_strtoupper($letter1);
            $a .= $letter1;
        }
    }

    return $a;
}

$t = "привет мир! ";
echo translit_rus_to_eng($t);

$t = "ПРИВЕТ МИР! ";
echo translit_rus_to_eng($t);

$t = "Привет мир! ";
echo translit_rus_to_eng($t);


/**
 * 2. Сделайте функцию, которая возвращает множественное или
 * единственное число существительного. Пример: 1 яблоко, 2 (3, 4)
 * яблока, 5 яблок. Функция первым параметром принимает число, а
 * следующие 3 параметра — форма для единственного числа, для чисел
 * два, три, четыре и для чисел, больших четырех, например, func(3,
 * "яблоко", "яблока", "яблок").
 */
echo "<br>2. ";

function apple($n, $str1, $str2, $str3) 
{
    $a = "";
    
    switch($n) {
        case ($n == 1):
            $a .= $n . " " . $str1;
            break;
        case ($n >= 2 and $n <= 4):
            $a .= $n . " " . $str2;
            break;
        case ($n == 0 or $n >= 5):
            $a .= $n . " " . $str3;
            break;
        default:
            $a .= $n . " " . $str2;
    }
    
    return $a;
}

echo apple(10, "яблоко", "яблока", "яблок");

/**
 * 3. Найдите все счастливые билеты. 
 * Счастливый билет - это билет, в котором сумма первых трех цифр его номера 
 * равна сумме вторых трех цифр его номера.
 */
echo "<br>3. ";

function lucky_ticket($ticket) 
{
        while (strlen($ticket) < 6) {
        $ticket = "0" . $ticket;
    }

    $arr = str_split($ticket, 3);
    $one = array_sum(str_split($arr[0]));
    $two = array_sum(str_split($arr[1]));

    $lucky = false;

    switch ($arr) {
        case ($one == $two):
            $lucky = implode($arr);
            break;
    }

    return $lucky;
}

for ($i=1; $i<=1200; $i++) {
    $lucky_ticket = lucky_ticket($i);
    if ($lucky_ticket !== false) {
        echo "счастливый билет - $lucky_ticket; ";
    }
}

/**
 * 4. Дружественные числа - два различных числа, для которых сумма всех 
 * собственных делителей первого числа равна второму числу и наоборот,
 * сумма всех собственных делителей второго числа равна первому числу.
 * Например, 220 и 284 Делители для 220 это 1, 2, 4, 5, 10, 11, 20, 22, 44, 55
 * и 110, сумма делителей равна 284 Делители для 284 это 1, 2, 4, 71 и 142,
 * их сумма равна 220.
 * Задача: найдите все пары дружественных чисел в промежутке от 1 до
 * 10000 Для этого сделайте вспомогательную функцию, которая находит
 * все делители числа и возвращает их в виде массива. Также сделайте
 * функцию, которая параметром принимает массив, а возвращает его сумму.
 */
echo "<br>4. ";

function getDelitely($n)
{
    $arrDiv = [];
    for ($i=1; $i <= $n; $i++) {
        if ($n % $i == 0) {
            $arrDiv[] = $i;
        }
    }

    return $arrDiv;
}
    
    function arrSumm($arr)
    {
        $result = 0;
        foreach ($arr as $value) {
            $result += $value;
        }

        return $result;
    }
    
    for ($i=1; $i <= 10000; $i++) {
        $one = getDelitely($i);
        array_pop($one);
        $one2 = array_sum($one);

        $two = getDelitely($one2);
        array_pop($two);
        $two2 = array_sum($two);
        if ($i == $two2 && $i != $one2) {
            echo "$i - $one2; ";
        } else {
            continue;
        }
    } 


