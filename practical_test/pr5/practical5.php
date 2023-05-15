<?php

/**
 * а) реализовать функцию, вычисляющую факториал числа. 
 * Вызов функции произвести в блоке try…catch. 
 * Обработку ошибок каждого типа производить в своем классе, 
 * наследованным от Exception.
 */

class NegativeNumberException extends Exception {}
class NonIntegerException extends Exception {}

function factorial($n) 
{
    if ($n < 0) {
        throw new NegativeNumberException("Нельзя вычислить факториал отрицательного числа!");
    }

    if (!is_int($n)) {
        throw new NonIntegerException("Нельзя вычислить факториал нецелого числа");
    }

    $result = 1;

    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }

    return $result;
}

try {
    $n = 5;
    $result = factorial($n);
    echo "Факториал числа $n равен $result";

} catch (NegativeNumberException $e) {
    echo $e->getMessage();

} catch (NonIntegerException $e) {
    echo $e->getMessage();

} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
}

echo "<br>";

/**
 * б) реализовать класс, находящий корни квадратного уравнения. 
 * Вызов методов экземпляра класса произвести в блоке try…catch. 
 * Обработку ошибок каждого типа производить в своем классе, 
 * наследованным от Exception.
 */

class InvalidQuadraticArgumentException extends Exception {} 
class ZeroCoefficientException extends Exception {} 
class NegativeDiscriminantException extends Exception {} 

function is_numeric_string($str) 
{
    return preg_match('/^-?\d*\.?\d+$/', $str) === 1;
}
 
class QuadraticEquation 
{ 
    private $a; 
    private $b; 
    private $c; 
 
    public function __construct($a, $b, $c) 
    { 
        $this->a = $a; 
        $this->b = $b; 
        $this->c = $c; 
 
        $this->validateCoefficients(); 
    } 
 
    public function validateCoefficients() 
    { 
        if (!is_numeric_string($this->a) || !is_numeric_string($this->b) || !is_numeric_string($this->c)) { 
            throw new InvalidQuadraticArgumentException("Коэффициенты должны быть числами"); 
        } 
    } 
 
    public function solve() 
    { 
        if ($this->a == 0) { 
            throw new ZeroCoefficientException("Коэффициент a не может быть равен 0"); 
        } 
 
        $discriminant = ($this->b ** 2) - (4 * $this->a * $this->c); 
 
        if ($discriminant < 0) { 
            return "Дискриминант отрицательный: нет корней"; 
        } 
 
        if ($discriminant == 0) { 
            $x1 = -$this->b / (2 * $this->a); 
            return [$x1]; 
        } 
 
        $x1 = (-$this->b + sqrt($discriminant)) / (2 * $this->a); 
        $x2 = (-$this->b - sqrt($discriminant)) / (2 * $this->a); 
        return [$x1, $x2]; 
    } 
} 
 
try { 
    $equation = new QuadraticEquation('iu', -5, 6); 
    $roots = $equation->solve(); 
 
    if (is_array($roots)) { 
        if (count($roots) == 1) { 
            echo "Уравнение имеет один корень: " . $roots[0]; 

        } else { 
            echo "Уравнение имеет два корня: " . $roots[0] . ", " . $roots[1]; 
        } 

    } else { 
        echo $roots; 
    } 
 
} catch (ZeroCoefficientException $e) { 
    echo "Ошибка: " . $e->getMessage(); 
 
} catch (NegativeDiscriminantException $e) { 
    echo "Ошибка: " . $e->getMessage(); 
 
} catch (InvalidQuadraticArgumentException $e) {
    echo "Ошибка: " . $e->getMessage();
} catch (Exception $e) {
    echo "Неизвестная ошибка: " . $e->getMessage();
}