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
            ("Число слишком большое для вычисления факториала.", 3);
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

        e.showAlert();
        e.logError();

    } else if (e instanceof NegativeNumberException) {

        e.showAlert();
        e.logError();

    } else if (e instanceof BigNumberException) {

        e.showAlert();
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

        if (!isNumber(this.a) || !isNumber(this.b) ||
        !isNumber(this.c)) {
            throw new InvalidQuadraticArgumentException
            ("Коэффициенты должны быть числами", 1); 
        }

        if (this.a == 0) {
            throw new ZeroCoefficientException
            ("Коэффициент a не может быть равен 0", 2); 
        }

    }

    solve()
    {

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

    if (e instanceof InvalidQuadraticArgumentException) {

        e.showAlert();
        e.logError();

    } else if (e instanceof ZeroCoefficientException) {

        e.showAlert();
        e.logError();

    } else {

        console.log("Неизвестная ошибка: " + e.message);
        alert("Неизвестная ошибка: " + e.message);
    
    }

}