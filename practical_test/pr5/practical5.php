<?php

require_once 'factorial_exception_classes.php';
 
/**
 * а) реализовать функцию, вычисляющую факториал числа. 
 * Вызов функции произвести в блоке try…catch. 
 * Обработку ошибок каждого типа производить в своем классе, 
 * наследованным от Exception.
 */

function factorial($n) 
{
    if (!is_int($n)) {
        throw new FactorialNumberException
        ("Аргумент должен быть целым числом.", 1);
    }

    if ($n < 0) {
        throw new NegativeNumberException
        ("Число должно быть неотрицательным.", 2);
    }

    if ($n > 20) {
        throw new BigNumberException
        ("Число слишком большое для вычисления факториала.", 3);
    }

    if ($n === 0) {
        return 1;
    }

    $factorial = 1;

    for ($i = 1; $i <= $n; $i++) {
        $factorial *= $i;
    }

    return $factorial;
}

try {

    $n = '5';

    $result = factorial($n);
    echo "Факториал числа $n равен $result";

} catch (FactorialNumberException $e) {

    echo $e->showError();
    $e->logError();

} catch (NegativeNumberException $e) {
    
    echo $e->showError();
    $e->logError();

} catch (BigNumberException $e) {
    
    echo $e->showError();
    $e->logError();

} catch (Exception $e) {

    echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
    $e->getMessage() . "</span>";

}

echo "<br>";

/**
 * б) реализовать класс, находящий корни квадратного уравнения. 
 * Вызов методов экземпляра класса произвести в блоке try…catch. 
 * Обработку ошибок каждого типа производить в своем классе, 
 * наследованным от Exception.
 */

require_once 'solve_exception_classes.php';

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

        if (!is_numeric($this->a) || !is_numeric($this->b) || 
        !is_numeric($this->c)) { 
            throw new InvalidQuadraticArgumentException
            ("Коэффициенты должны быть числами", 1); 
        } 

        if ($this->a == 0) { 
            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0", 2); 
        } 
    } 
 
    public function solve() 
    {
 
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

    public function showResult()
    {
        $roots = $this->solve(); 
 
        if (is_array($roots)) { 

            if (count($roots) == 1) { 
                return "Уравнение имеет один корень: " . $roots[0]; 
    
            } else { 
                return "Уравнение имеет два корня: " . $roots[0] . ", " .
                $roots[1]; 
            } 
    
        } else { 
            return $roots; 
        } 

    }

} 
 
try { 

    $equation = new QuadraticEquation(6, -5, 6); 

    echo $equation->showResult(); 
 
} catch (ZeroCoefficientException $e) { 
    
    echo $e->showError();
    $e->logError();
 
} catch (InvalidQuadraticArgumentException $e) {
    
    echo $e->showError();
    $e->logError();

} catch (Exception $e) {

    echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
    $e->getMessage() . "</span>";

}
