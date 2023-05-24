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

    if ($n === 0) {

        return 1;

    } elseif (!$n) {

        throw new NoNumberException 
        ("Аргумент не задан.", 1);

    } elseif (!is_int($n)) {

        throw new NumberException
        ("Аргумент должен быть целым числом.", 2);

    } elseif ($n < 0) {

        throw new NegativeNumberException
        ("Число должно быть неотрицательным.", 3);

    } elseif ($n > 20) {

        throw new BigNumberException
        ("Число слишком большое для вычисления факториала.", 4);

    } else {

        $factorial = 1;

        for ($i = 1; $i <= $n; $i++) {
            $factorial *= $i;
        }

        return $factorial;

    }
    
}
 
try {

    $n = 5;

    $result = factorial($n);
    echo "Факториал числа $n равен $result";

} catch (NumberException $e) {

    echo $e->showError();
    $e->logError();

} catch (NegativeNumberException $e) {
    
    echo $e->showError();
    $e->logError();

} catch (BigNumberException $e) {
     
    echo $e->showError();
    $e->logError();

} catch (NoNumberException $e) {
     
    echo $e->showError();
    $e->logError();

} catch (Exception $e) {

    echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
    $e->getMessage() . "</span>";

}

echo "<br><br>";

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

        if ($this->a === 0 && $this->b === 0 && $this->c === 0) { 
            throw new ZeroCoefficientException
            ("Коэффициент a,b и c равны 0", 1); 
        } 
        if ($this->a === 0) { 
            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0", 2); 
        } 


        if ($this->a === null && $this->b === null && $this->c === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a, c и b не заданы", 3); 
        } 
        if ($this->a === null && $this->b === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a и b не заданы", 4); 
        } 
        if ($this->a === null && $this->c === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a и c не заданы", 5); 
        } 
        if ($this->b === null && $this->c === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент b и c не заданы", 6); 
        }
        if ($this->a === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент а не задан", 7); 
        } 
        if ($this->b === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент b не задан", 8); 
        } 
        if ($this->c === null) {
            throw new NoQuadraticArgumentException
            ("Коэффицент c не задан", 9); 
        } 


        if (!is_numeric($this->a) && !is_numeric($this->b) && !is_numeric($this->c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a, c и b должны быть числами", 16); 
        } 
        if (!is_numeric($this->a) && !is_numeric($this->b)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a и b должны быть числами", 13); 
        } 
        if (!is_numeric($this->a) && !is_numeric($this->c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a и c должны быть числами", 14); 
        } 
        if (!is_numeric($this->b) && !is_numeric($this->c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент b и c должны быть числами", 15); 
        } 
        if (!is_numeric($this->a)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент а должен быть числом", 10); 
        } 
        if (!is_numeric($this->b)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент b должен быть числом", 11); 
        } 
        if (!is_numeric($this->c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент c должен быть числом", 12); 
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

    $equation = new QuadraticEquation(0, 0, 0); 

    echo $equation->showResult(); 

 
} catch (ZeroCoefficientException $e) { 
    
    echo $e->showError();
    $e->logError();
    echo "<br>";
 
} catch (NoQuadraticArgumentException $e) { 
    
    echo $e->showError();
    $e->logError();
    echo "<br>";
 
} catch (InvalidQuadraticArgumentException $e) {
    
    echo $e->showError();
    $e->logError();
    echo "<br>";

} catch (Exception $e) {

    echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
    $e->getMessage() . "</span>";
    echo "<br>";

}
    














// $arr = [
//     [1, 1, 1],
//     [0, 1, 1],
//     [1, 0, 1],
//     [1, 1, 0],
//     [0, 0, 1],
//     [1, 0, 0],
//     [0, 0, 0],
//     ['a', 1, 1],
//     [1, 'b', 1],
//     [1, 1, 'c'],
//     ['a', 'b', 1],
//     [1, 'b', 'c'],
//     ['a', 'b', 'c'],
//     [null, 1, 1],
//     [1, null, 1],
//     [1, 1, null],
//     [null, null, 1],
//     [1, null, null],
//     [null, null, null]
// ];


// foreach ($arr as $el) {
//     try { 
//     $a = $el[0];
//     $b = $el[1];
//     $c = $el[2];

//     $eq = new QuadraticEquation($a, $b, $c);
//     echo $eq->showResult()."<br>";

//     } catch (ZeroCoefficientException $e) { 
        
//         echo $e->showError();
//         $e->logError();
//         echo "<br>";
    
//     } catch (NoQuadraticArgumentException $e) { 
        
//         echo $e->showError();
//         $e->logError();
//         echo "<br>";
    
//     } catch (InvalidQuadraticArgumentException $e) {
        
//         echo $e->showError();
//         $e->logError();
//         echo "<br>";

//     } catch (Exception $e) {

//         echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
//         $e->getMessage() . "</span>";
//         echo "<br>";

//     }

// }