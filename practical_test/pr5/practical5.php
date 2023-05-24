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

    } elseif (is_float($n)) {

        throw new NumberException
        ("Аргумент должен быть целым числом.", 2);

    } elseif (!is_int($n)) {

        throw new NumberException
        ("Аргумент должен быть числом.", 2);

    } elseif ($n < 0) {

        throw new NegativeNumberException
        ("Число должно быть неотрицательным.", 3);

    } elseif ($n > 20) {

        throw new BigNumberException
        ("Число слишком большое для вычисления факториала.", 4);

    } else {

        return $n * factorial($n - 1);

    }
    
}
 
// try {

//     $n = 0;

//     $result = factorial($n);
//     echo "Факториал числа $n равен $result";

// } catch (NumberException $e) {

//     echo $e->showError();
//     $e->logError();

// } catch (NegativeNumberException $e) {
    
//     echo $e->showError();
//     $e->logError();

// } catch (BigNumberException $e) {
     
//     echo $e->showError();
//     $e->logError();

// } catch (NoNumberException $e) {
     
//     echo $e->showError();
//     $e->logError();

// } catch (Exception $e) {

//     echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
//     $e->getMessage() . "</span>";

// }

$arrf = [-100, 'a', '', null, [1, 1], 3.1, -1, 0, 1, 5, 10, 100];

foreach ($arrf as $el) {

    try {

        $result = factorial($el);
        echo "Факториал числа $el равен $result<br>";

    } catch (NumberException $e) {

        echo $e->showError();
        $e->logError();
        echo "<br>";

    } catch (NegativeNumberException $e) {
        
        echo $e->showError();
        $e->logError();
        echo "<br>";

    } catch (BigNumberException $e) {
        
        echo $e->showError();
        $e->logError();
        echo "<br>";

    } catch (NoNumberException $e) {
        
        echo $e->showError();
        $e->logError();
        echo "<br>";

    } catch (Exception $e) {

        echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
        $e->getMessage() . "</span>";
        echo "<br>";

    }

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

        if ($this->a === null && $this->b === null && $this->c === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент a, c и b не заданы", 3); 

        } elseif ($this->a === null && $this->b === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент a и b не заданы", 4); 

        } elseif ($this->a === null && $this->c === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент a и c не заданы", 5); 

        } elseif ($this->b === null && $this->c === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент b и c не заданы", 6); 

        } elseif ($this->a === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент а не задан", 7); 

        } elseif ($this->b === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент b не задан", 8); 

        } elseif ($this->c === null) {

            throw new NoQuadraticArgumentException
            ("Коэффициент c не задан", 9); 

        } 

        if ($this->a == 0 && $this->b == 0 && $this->c == 0) { 

            throw new ZeroCoefficientException
            ("Коэффициент a,b и c равны 0", 1); 

        } elseif ($this->a == 0) { 

            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0", 2); 

        } 

        if (!is_numeric($this->a) && !is_numeric($this->b) && !is_numeric($this->c)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент a, c и b должны быть числами", 16); 

        } elseif (!is_numeric($this->a) && !is_numeric($this->b)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент a и b должны быть числами", 13); 

        } elseif (!is_numeric($this->a) && !is_numeric($this->c)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент a и c должны быть числами", 14); 

        } elseif (!is_numeric($this->b) && !is_numeric($this->c)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент b и c должны быть числами", 15); 

        } elseif (!is_numeric($this->a)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент а должен быть числом", 10); 

        } elseif (!is_numeric($this->b)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент b должен быть числом", 11); 

        } elseif (!is_numeric($this->c)) {

            throw new InvalidQuadraticArgumentException
            ("Коэффициент c должен быть числом", 12); 

        } 

    } 
 
    public function solve() 
    {
 
        $discriminant = ($this->b ** 2) - (4 * $this->a * $this->c); 
 
        if ($discriminant < 0) { 

            return "Дискриминант отрицательный: нет корней"; 

        } elseif ($discriminant == 0) { 

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
 
// try { 

//     $equation = new QuadraticEquation(0, 0, 0); 

//     echo $equation->showResult(); 

 
// } catch (ZeroCoefficientException $e) { 
    
//     echo $e->showError();
//     $e->logError();
//     echo "<br>";
 
// } catch (NoQuadraticArgumentException $e) { 
    
//     echo $e->showError();
//     $e->logError();
//     echo "<br>";
 
// } catch (InvalidQuadraticArgumentException $e) {
    
//     echo $e->showError();
//     $e->logError();
//     echo "<br>";

// } catch (Exception $e) {

//     echo "<span style='color: red;'>Произошла неизвестная ошибка: " . 
//     $e->getMessage() . "</span>";
//     echo "<br>";

// }
    














$arrq = [
    [1, 1, 1],
    [0, 1, 1],
    [1, 0, 1],
    [1, 1, 0],
    [0, 0, 1],
    [0, 1, 0],
    [1, 0, 0],
    [0, 0, 0],
    ['a', 1, 1],
    [1, 'b', 1],
    [1, 1, 'c'],
    ['a', 'b', 1],
    [1, 'b', 'c'],
    ['a', 'b', 'c'],
    [null, 1, 1],
    [1, null, 1],
    [1, 1, null],
    [null, null, 1],
    [1, null, null],
    [null, 1, null],
    [null, null, null],
];


foreach ($arrq as $el) {

    try { 
        
        $a = $el[0];
        $b = $el[1];
        $c = $el[2];

        echo "$a $b $c - ";



        $eq = new QuadraticEquation($a, $b, $c);
        echo $eq->showResult()."<br>";

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

}