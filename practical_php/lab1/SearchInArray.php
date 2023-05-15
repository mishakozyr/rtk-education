<?php

class SearchInArray
{
    /**
     * Поиск элемента в массиве линейным способом
     * @param array $array - массив целых чисел
     * @param mixed $search_value - что ищем
     * @return array - возвращает массив ["индекс" => "значение"] найденных элементов или пустой массив, если элементов не было найдено
     */
    public static function linearSearch(array $array, int $search_value): array
    {
        $arr = [];
        // перебор всех элементов массива, если значения одиннаковые то заносит в массив
        foreach ($array as $index => $value) {
            if ($search_value === $value) {
                $arr[] = [$index => $value];
                return $arr;
            }
        }
        return $arr;
    }

    /**
     * Поиск элемента в упорядоченном массиве бинарным способом
     * @param array $array - упорядоченный по возрастанию массив целых чисел
     * @param int $search_value - что ищем
     * @return array - возвращает массив ["индекс" => "значение"] найденных элементов или пустой массив, если элементов не было найдено
     */
    public static function binarySearch(array $array, int $search_value): array
    {
        $arr = [];
        arsort($array); // сортировка массива по возрастанию
        $first_index = 0;
        $end_index = count($array) - 1;  
        while ($first_index <= $end_index) {
            // получаем индекс среднего элемента массива и проверяем
            $middle_index = round(($first_index + $end_index ) / 2 ); // round округляет до целого числа          
            $value = $array[$middle_index];   
            if ($value == $search_value) {
                $arr[] = [$middle_index => $value];
                return $arr;
            } elseif ($value > $search_value) {
                $end_index = $middle_index - 1;
            } else {
                $first_index = $middle_index + 1;
            }       
        }
        return $arr;
    }
}