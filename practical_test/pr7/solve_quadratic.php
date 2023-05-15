<?php

class InvalidQuadraticArgumentException extends Exception {}
class ZeroCoefficientException extends Exception {}
class NegativeDiscriminantException extends Exception {}

function is_numeric_string($str) {
    return is_numeric($str);
}

class QuadraticEquation {
    private $a;
    private $b;
    private $c;

    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;

        $this->validateCoefficients();
    }

    public function validateCoefficients() {
        if (!is_numeric_string($this->a) || !is_numeric_string($this->b) || !is_numeric_string($this->c)) {
            throw new InvalidQuadraticArgumentException("Коэффициенты должны быть числами");
        }
    }

    public function solve() {
        if ($this->a == 0) {
            throw new ZeroCoefficientException("Коэффициент a не может быть равен 0");
        }

        $discriminant = pow($this->b, 2) - (4 * $this->a * $this->c);

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
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    
    $equation = new QuadraticEquation($a, $b, $c);
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
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";

} catch (NegativeDiscriminantException $e) {
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";

} catch (InvalidQuadraticArgumentException $e) {
    echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span>";
} catch (Exception $e) {
    echo "<span class='error-message'>Неизвестная ошибка: " . $e->getMessage() . "<span>";
}
