/**
 * реализовать класс, вычисляющий факториал числа. Вызов метода 
 * класса произвести в блоке try…catch. Обработку ошибок 
 * каждого типа производить в своем классе, 
 * наследованным от Error. 
 * 
 * - на JS, вызов методов классов должен быть доступен, 
 * как через консоль, так и через prompt/alert.
 */

class InvalidFactorialArgumentException extends Error {} 
class NegativeNumberException extends Error {}
class NonIntegerNumberException extends Error {}

class Factorial
{
    static compute(n) 
    {
        if (typeof n !== "number") {
            throw new InvalidFactorialArgumentException
            ("Коэффициент должен быть числом");
        }

        if (!Number.isInteger(n)) {
            throw new NonIntegerNumberException
            ("Коэффицент должен быть целым числом");
        }

        if (n < 0) {
            throw new NegativeNumberException
            ("Коэффицент должен быть неотрицательным числом");
        }

        let result = 1;

        for (let i = 2; i <= n; i++) {
            result *= i;
        }

        return result;
    }
}

try {
    const input = prompt
    ("Введите целое неотрицательное число для вычисления факториала:");
    const number = parseInt(input);

    const factorial = Factorial.compute(number);
    console.log(`${number}! = ${factorial}`);
    alert(`${number}! = ${factorial}`);

} catch (e) {
    if (e instanceof InvalidFactorialArgumentException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else if (e instanceof NonIntegerNumberException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else if (e instanceof NegativeNumberException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else {
        console.log("Неизвестная ошибка: " + e.message);
        alert("Неизвестная ошибка: " + e.message);
    }
}

/**
 * реализовать класс, находящий корни квадратного уравнения. 
 * Вызов метода класса произвести в блоке try…catch. 
 * Обработку ошибок каждого типа производить в своем классе, 
 * наследованным от Error. 
 * 
 * - на JS, вызов методов классов должен быть доступен, 
 * как через консоль, так и через prompt/alert.
 */

class InvalidQuadraticArgumentException extends Error {} 
class ZeroCoefficientException extends Error {}
class NegativeDiscriminantException extends Error {}

function isNumber(num) 
{
	return typeof num === 'number' && !isNaN(num);
}

class QuadraticEquation
{
    constructor(a, b, c) 
    {
        this.a = parseInt(a);
        this.b = parseInt(b);
        this.c = parseInt(c);

        this.validateCoefficients();
    }

    validateCoefficients()
    {
        if (!isNumber(this.a) || !isNumber(this.b) ||
        !isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффициенты должны быть числами"); 
        }
    }

    solve()
    {
        if (this.a == 0) {
            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0"); 
        }

        let discriminant = (this.b ** 2) - (4 *this.a * this.c);

        if (discriminant < 0) {
            return "Дискриминант отрицательный: нет корней"; 
        }

        if (discriminant == 0) { 
            let x1 = -this.b / (2 * this.a); 
            return [x1]; 
        } 

        let x1 = (-this.b + Math.sqrt(discriminant)) / (2 * this.a); 
        let x2 = (-this.b - Math.sqrt(discriminant)) / (2 * this.a); 
        return [x1, x2]; 
    }
}

try {
    let a = prompt("Введите коэффицент a:");
    let b = prompt("Введите коэффицент b:");
    let c = prompt("Введите коэффицент c:");

    let equation = new QuadraticEquation(a, b, c);
    let roots = equation.solve();

    if (Array.isArray(roots)) {
        if (roots.length == 1) {
            console.log("Уравнение имеет один корень: " + roots[0]);
            alert("Уравнение имеет один корень: " + roots[0]);
        } else {
            console.log("Уравнение имеет два корня: " + roots[0] + ", " + roots[1]);
            alert("Уравнение имеет два корня: " + roots[0] + ", " + roots[1]);
        }
    } else {
        console.log(roots);
        alert(roots);
    } 
} catch (e) {
    if (e instanceof ZeroCoefficientException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else if (e instanceof NegativeDiscriminantException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else if (e instanceof InvalidQuadraticArgumentException) {
        console.log("Ошибка: " + e.message);
        alert("Ошибка: " + e.message);

    } else {
        console.log("Неизвестная ошибка: " + e.message);
        alert("Неизвестная ошибка: " + e.message);
    }
}