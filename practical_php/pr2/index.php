<?php

// 1. Дан массив $arr. С помощью функции count выведите последний элемент данного массива.
echo "1. ";
$arr = [1, 2, 3, 4, 5];
echo count($arr);
echo "<br>";

// 2. Дан массив с числами. Проверьте, что в нем есть элемент со значением 3
echo "<br>2. ";
$arr = [1, 2, 3, 4, 5, 30];
if (in_array("3", $arr)) {
    echo "есть тройка";
} else {
    echo "нема";
}
echo "<br>";

// 3. Дан массив [1, 2, 3, 4, 5]. Найдите сумму элементов данного массива.
echo "<br>3. ";
$arr = [1, 2, 3, 4, 5];
echo array_sum($arr);
echo "<br>";

// 4. Дан массив $arr. С помощью функций array_sum и count найдите среднее арифметическое элементов (сумма элементов делить на их количество) данного массива.
echo "<br>4. ";
$arr = [1, 2, 3, 4, 5, 6];
echo (array_sum($arr) / count($arr));
echo "<br>";

// 5. Создайте массив, заполненный числами от 1 до 100
echo "<br>5. ";
foreach (range(0, 100) as $arr) {
    echo $arr;
}
echo "<br>";

// 6. Создайте массив, заполненный буквами от "a" до "z".
echo "<br>6. ";
foreach (range("a", "z") as $arr) {
    echo $arr;
}
echo "<br>";

// 7. Найдите сумму чисел от 1 до 100 не используя цикл.
echo "<br>7. ";
echo array_sum(range(0, 100));
echo "<br>";

// 8. Даны два массива: первый с элементами 1, 2, 3, второй с элементами "a", "b", "c". Сделайте из них массив с элементами 1, 2, 3, "a", "b", "c".
echo "<br>8. ";
$arr1 = [1, 2, 3];
$arr2 = ["a", "b", "c"];
$sum_arr = array_merge($arr1, $arr2);
print_r($sum_arr);
echo "<br>";

// 9. Дан массив с элементами 1, 2, 3, 4, 5. С помощью функции array_slice создайте из него массив $result с элементами 2, 3, 4
echo "<br>9. ";
$arr = [1, 2, 3, 4, 5];
$result = array_slice($arr, 1, 3);
print_r($result);
echo "<br>";

// 10. Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice преобразуйте массив в [1, 4, 5].
echo "<br>10. ";
$arr = [1, 2, 3, 4, 5];
array_splice($arr, 1, -2);
print_r($arr);
echo "<br>";

// 11. Дан массив [1, 2, 3, 4, 5]. С помощью функции array_splice сделайте из него массив [1, 2, 3, "a", "b", "c", 4, 5].
echo "<br>11. ";
$arr = [1, 2, 3, 4, 5];
array_splice($arr, 3, 0, array("a", "b", "c"));
print_r($arr);
echo "<br>";

// 12. Дан массив "a"=>1, "b"=>2, "c"=>3". Запишите в массив $keys ключи из этого массива, а в $values – значения.
echo "<br>12. ";
$arr = array("a"=>1, "b"=>2, "c"=>3);
$keys = array_keys($arr);
$values = array_values($arr);
print_r($keys);
print_r($values);
echo "<br>";

// 13. Даны два массива: ["a", "b", "c"] и [1, 2, 3]. Создайте с их помощью массив "a"=>1, "b"=>2, "c"=>3".
echo "<br>13. ";
$arr1 = ["a", "b", "c"];
$arr2 = [1, 2, 3];
print_r(array_combine($arr1, $arr2));
echo "<br>";

// 14. Дан массив "a"=>1, "b"=>2, "c"=>3. Поменяйте в нем местами ключи и значения.
echo "<br>14. ";
$arr = ["a"=>1, "b"=>2, "c"=>3];
print_r(array_flip($arr));
echo "<br>";

// 15. Дан массив с элементами 1, 2, 3, 4, 5. Сделайте из него массив с элементами 5, 4, 3, 2, 1
echo "<br>15. ";
$arr = [1, 2, 3, 4, 5];
print_r(array_reverse($arr));
echo "<br>";

// 16. Дан массив ["a", "-", "b", "-", "c", "-", "d"]. Найдите позицию первого элемента "-".
echo "<br>16. ";
$arr = ["a", "-", "b", "-", "c", "-", "d"];
echo array_search("-", $arr);
echo "<br>";

// 17. Дан массив ["a", "-", "b", "-", "c", "-", "d"]. Найдите позицию первого элемента "-" и удалите его с помощью функции array_splice.
echo "<br>17. ";
$arr = ["a", "-", "b", "-", "c", "-", "d"];
array_splice($arr, array_search("-", $arr), 1);
print_r ($arr)  . "<br>";
echo "<br>";

// 18. Дан массив ["a", "b", "c", "d", "e"]. Поменяйте элемент с ключом 0 на "!", а элемент с ключом 3 - на "!!".
echo "<br>18. ";
$arr = ["a", "b", "c", "d", "e"];
$zam = [0 => "!", 3 => "!!"];
print_r(array_replace($arr, $zam));
echo "<br>";

// 19. Дан массив "3"=>"a", "1"=>"c", "2"=>"e", "4"=>"b". Попробуйте на нем различные типы сортировок.
echo "<br>19. ";
$arr = ["3"=>"a", "1"=>"c", "2"=>"e", "4"=>"b"];
sort($arr); // сортировка массивов в порядке возрастания
print_r($arr); echo "<br>";
rsort($arr); // сортировка массивов в порядке убывания
print_r($arr); echo "<br>";
asort($arr); // сортировать ассоциативный массив в порядке возрастания значений
print_r($arr); echo "<br>";
ksort($arr); // сортировка ассоциативных массивов в порядке возрастания в соответствии с ключом
print_r($arr); echo "<br>";
arsort($arr); // сортировка ассоциативных массивов в порядке убывания в соответствии со значением
print_r($arr); echo "<br>";
krsort($arr); // сортировка ассоциативных массивов в порядке убывания в соответствии с ключом
print_r($arr); echo "<br>";

// 20. Дан массив с элементами "a"=>1, "b"=>2, "c"=>3. Выведите на экран случайный ключ из данного массива.
echo "<br>20. ";
$arr = ["a"=>1, "b"=>2, "c"=>3];
print_r(array_rand($arr));
echo "<br>";

// 21. Дан массив с элементами "a"=>1, "b"=>2, "c"=>3.  Выведите  на экран случайный элемент данного массива.
echo "<br>21. ";
$arr = ["a"=>1, "b"=>2, "c"=>3];
print_r($arr[array_rand($arr)]);
echo "<br>";

// 22. Дан массив $arr. Перемешайте его элементы в случайном порядке.
echo "<br>22. ";
$arr = ["a", "b", "c", "d", "e"];
shuffle($arr);
print_r($arr);
echo "<br>";

// 23. Заполните массив числами от 1 до 25 с помощью range, а затем перемешайте его элементы в случайном порядке.
echo "<br>23. ";
$arr = range(1, 25);
shuffle($arr);
print_r($arr);
echo "<br>";

// 24. Сделайте строку длиной 6 символов, состоящую из маленьких английских букв, расположенных в случайном порядке. Буквы не должны повторяться.
echo "<br>24. ";
$arr = range("a", "z");
shuffle($arr);
print_r(array_slice($arr, 1, 6));
echo "<br>";

// 25. Дан массив с элементами "a", "b", "c", "b", "a". Удалите из него повторяющиеся элементы.
echo "<br>25. ";
$arr = ["a", "b", "c", "b", "a"];
print_r(array_unique($arr));
echo "<br>";

// 26. Дан массив с элементами 1, 2, 3, 4, 5. Выведите на экран его первый и последний элемент, причем так, чтобы в исходном массиве они исчезли.
echo "<br>26. ";
$arr = [1, 2, 3, 4, 5];
echo array_shift($arr) . " и " . array_pop ($arr);
echo "<br>";

// 27. Дан массив с элементами 1, 2, 3, 4, 5, 6, 7, 8. С помощью цикла и функций array_shift и array_pop выведите на экран его элементы в следующем порядке: 18273645
echo "<br>27. ";
$arr = [1, 2, 3, 4, 5, 6, 7, 8];
for ($a = array_shift($arr), $b = array_pop($arr); $a !== null; $a = array_shift($arr), $b = array_pop($arr)){
    echo $a . $b;
}
echo "<br>";

// 28. Дан массив с элементами "a", "b", "c". Сделайте из него массив с элементами "a", "b", "c", "-", "-", "-".
echo "<br>28. ";
$arr = ["a", "b", "c"];
print_r(array_pad($arr, 6, "-"));
echo "<br>";

// 29. Создайте массив, заполненный целыми числами от 1 до 20. С помощью функции array_chunk разбейте этот массив на 5 подмассивов ([1, 2, 3, 4]; [5, 6, 7, 8] и т.д.).
echo "<br>29. ";
$arr = range(1, 20);
print_r(array_chunk($arr, 4));
echo "<br>";

// 30. Дан массив с элементами "a", "b", "c", "b", "a". Подсчитайте сколько раз встречается каждая из букв.
echo "<br>30. ";
$arr = ["a", "b", "c", "b", "a"];
print_r(array_count_values($arr));
echo "<br>";

// 31. Дан массив с элементами 1, 2, 3, 4, 5 Создайте новый массив, в котором будут лежать квадратные корни данных элементов.
echo "<br>31. ";
$arr = [1, 2, 3, 4, 5];
function cor($mas) {
return $mas**2;
}
print_r(array_map("cor", $arr));
echo "<br>";

// 32. Дан массив с элементами "<b>php</b>", "<i>html</i>". Создайте новый массив, в котором из элементов будут удалены теги.
echo "<br>32. ";
$arr = ["<b>php</b>", "<i>html</i>"];
print_r(array_map("strip_tags", $arr));
echo "<br>";

// 33. Дан массив с элементами 1, 2, 3, 4, 5 и массив с элементами 3, 4, 5, 6, 7 Запишите в новый массив элементы, которые есть и в том, и в другом массиве.
echo "<br>33. ";
$arr1 = [1, 2, 3, 4, 5];
$arr2 = [3, 4, 5, 6, 7];
print_r(array_intersect($arr1, $arr2));
echo "<br>";

// 34. Дан массив с элементами 1, 2, 3, 4, 5 и массив с элементами 3, 4, 5, 6, 7 Запишите в новый массив элементы, которые не присутствуют в обоих массивах одновременно.
echo "<br>34. ";
$arr1 = [1, 2, 3, 4, 5];
$arr2 = [3, 4, 5, 6, 7];
$mas = array_diff($arr1, $arr2);
print_r ($mas);

?>