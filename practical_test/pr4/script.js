try {
    const numberOfArmies = promptInteger("Введите количество армий:");
    validatePositiveNumber(numberOfArmies, "Количество армий должно быть положительным числом.");
    if (numberOfArmies === 1) {
        throw new Error("Количество армий должно быть больше одной.");
    }
    const armies = createArmies(numberOfArmies);
    const game = new Game(armies);
} catch (error) {
    console.error(error); 
}

// если введенное значение не является числом, функция будет запрашивать число до тех пор, пока не будет получено корректное значение.
function promptInteger(message) {
    let value;
    do {
        value = parseInt(prompt(message));
    } while (isNaN(value));
    return value;
}

// если значение <=0, функция выбрасывает ошибку с заданным сообщением.
function validatePositiveNumber(value, message) {
    if (value <= 0) {
        throw new Error(message);
    }
}

function createArmies(numberOfArmies) {
    const armies = [];
    for (let i = 1; i <= numberOfArmies; i++) {
        let armyName = '';
        while (!armyName) {
            armyName = prompt(`Введите имя армии ${i}:`);
        }
        const armyUnits = promptInteger(`Введите количество юнитов для армии ${i}:`);
        validatePositiveNumber(armyUnits, `Количество юнитов для армии ${i} должно быть положительным числом.`);
        armies.push(new Army(armyName, armyUnits));
    }
    return armies;
}
