/**
 * реализовать класс, вычисляющий факториал числа. Вызов метода 
 * класса произвести в блоке try…catch. Обработку ошибок 
 * каждого типа производить в своем классе, 
 * наследованным от Error. 
 * 
 * - на JS, вызов методов классов должен быть доступен, 
 * как через консоль, так и через prompt/alert.
 */

class Factorial
{

    constructor(n) 
    {
        this.n = parseInt(n);
        this.validateNumber();
    }

    validateNumber()
    {
        // typeof n !== "number"

        if (!this.n || this.n == "NaN") {
            throw new FactorialNoNumberException
            ("Аргумент не задан.", 1);
        }

        if (!Number.isInteger(this.n)) {
            throw new FactorialNumberException
            ("Коэффицент должен быть целым числом", 2);
        }

        if (this.n < 0) {
            throw new NegativeNumberException
            ("Коэффицент должен быть неотрицательным числом", 3);
        }

        if (this.n > 20) {
            throw new BigNumberException
            ("Число слишком большое для вычисления факториала.", 4);
        }
    }

    compute() 
    {
        let result = 1;

        for (let i = 2; i <= this.n; i++) {
            result *= i;
        }

        return result;
    }

    showResult()
    {
        const number = this.n;
        const factorial = this.compute();

        console.log(`${number}! = ${factorial}`);
        alert(`${number}! = ${factorial}`);
    }
}

try {

    const number = prompt
    ("Введите целое неотрицательное число для вычисления факториала:");

    const equation = new Factorial(number);

    equation.showResult();

} catch (e) {

    if (e instanceof FactorialNumberException) {

        e.logError();

    } else if (e instanceof NegativeNumberException) {

        e.logError();

    } else if (e instanceof BigNumberException) {
 
        e.logError();

    } else if (e instanceof FactorialNoNumberException) {
 
        e.logError();

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

        if (!this.a) {
            throw new NoQuadraticArgumentException
            ("Коэффицент а не задан", 1); 
        } else if (!this.b) {
            throw new NoQuadraticArgumentException
            ("Коэффицент b не задан", 2); 
        } else if (!this.c) {
            throw new NoQuadraticArgumentException
            ("Коэффицент c не задан", 3); 
        } else if (!this.a && !this.b) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a и b не заданы", 4); 
        } else if (!this.a && !this.c) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a и c не заданы", 5); 
        } else if (!this.b && !this.c) {
            throw new NoQuadraticArgumentException
            ("Коэффицент b и c не заданы", 6); 
        } else if (!this.a && !this.b && !this.c) {
            throw new NoQuadraticArgumentException
            ("Коэффицент a, c и b не заданы", 7); 
        } 

        if (!isNumber(this.a)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент а должен быть числом", 8); 
        } else if (!isNumber(this.b)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент b должен быть числом", 9); 
        } else if (!isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент c должен быть числом", 10); 
        } else if (!isNumber(this.a) && !isNumber(this.b)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a и b должны быть числами", 11); 
        } else if (!isNumber(this.a) && !isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a и c должны быть числами", 12); 
        } else if (!isNumber(this.b) && !isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент b и c должны быть числами", 13); 
        } else if (!isNumber(this.a) && !isNumber(this.b) && !isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффицент a, c и b должны быть числами", 14); 
        } 

        if (this.a == 0) { 
            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0", 15); 
        } else if (this.a == 0 && this.b == 0 && this.c == 16) { 
            throw new ZeroCoefficientException
            ("Коэффициент a, b и c равны 0", 3); 
        } 

    }

    solve()
    {

        let discriminant = (this.b ** 2) - (4 *this.a * this.c);

        if (discriminant < 0) {
            return "Дискриминант отрицательный: нет корней"; 
        } else if (discriminant == 0) { 
            let x1 = -this.b / (2 * this.a); 
            return [x1]; 
        } 

        let x1 = (-this.b + Math.sqrt(discriminant)) / (2 * this.a); 
        let x2 = (-this.b - Math.sqrt(discriminant)) / (2 * this.a); 
        return [x1, x2]; 

    }

    showResult()
    {

        const roots = this.solve();

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
        
    }
}

try {

    let a = prompt("Введите коэффицент a:");
    let b = prompt("Введите коэффицент b:");
    let c = prompt("Введите коэффицент c:");

    const equation = new QuadraticEquation(a, b, c);

    equation.showResult();

} catch (e) {

    if (e instanceof NoQuadraticArgumentException) {

        e.logError();

    } else if (e instanceof InvalidQuadraticArgumentException) {

        e.logError();

    } else if (e instanceof ZeroCoefficientException) {

        e.logError();

    } else {

        console.log("Неизвестная ошибка: " + e.message);
        alert("Неизвестная ошибка: " + e.message);
    
    }

}