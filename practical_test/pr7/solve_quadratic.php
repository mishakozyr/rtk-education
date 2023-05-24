<?php


require_once '../pr5/solve_exception_classes.php';

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

try { 
        
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];

    $eq = new QuadraticEquation($a, $b, $c);
    echo $eq->showResult();

} catch (ZeroCoefficientException $e) { 
    
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";

} catch (NoQuadraticArgumentException $e) { 
    
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";

} catch (InvalidQuadraticArgumentException $e) {
    
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";

} catch (Exception $e) {

    echo "<span class='error-message'>Неизвестная ошибка: " . $e->getMessage() . "<span>";

}