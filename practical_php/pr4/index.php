<?php

// Задача 1. Используя рекурсию, реализовать функцию вычисления факториала числа.
echo '1. ';

function factorial($num)
{
    $res = false;
    if (is_int($num) && ($num > 0)) {
        $res = $num * factorial($num - 1);
    } elseif ($num == 0) {
        $res = 1;
    }
    return $res;
}

var_dump(factorial(-5));
var_dump(factorial(0));
var_dump(factorial(5));
var_dump(factorial(5.0));
var_dump(factorial(-5.0));

/**
 * Задача 2. Дан массив вида, который может иметь неограниченную вложенность.
 * Требуется реализовать рекурсивную функцию, которая, на основе данного массива
 * формировала список. Для формирования списка используются теги «<ul></ul><li></li>». 
 */
echo '<br>2. ';

$someArray = [
    'id' => 1,
    'name' => 'item1',
    'items' => [
        [
            'id' => 2,
            'name' => 'item2',
            'items' => [],
        ],
        [
            'id' => 3,
            'name' => 'item3',
            'items' => [],
        ],
        [
            'id' => 4,
            'name' => 'item4',
            'items' => [
                [
                    'id' => 5,
                    'name' => 'item5',
                    'items' => [],
                ],
                [
                    'id' => 6,
                    'name' => 'item6',
                    'items' => [],
                ],
            ],
        ],
    ]
];

function func1($arr, $r = false) 
{
    $r .= '<ul>';
    foreach($arr as $e => $y) {
        $r .= '<li>';
        if ($y == []) {
            $r .= $e . ' => ' . '[]';
        } 
        if ($y !== [] && !is_int($y) && !is_string($y) && !in_array(0, $y)) {
            $r .= $e . ' => ';
        } 
        if (is_array($y)) {
            $r .= func1($y);
        } else {
            $r .= $e . ' => ' . $y;
        }
        $r .= '</li>';
    }
    $r .= '</ul>';
    
    return $r;
}

echo func1($someArray);
