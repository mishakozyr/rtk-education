try {
    const numberOfArmies = promptInteger("Введите количество армий:");
    
    if (numberOfArmies <= 1) {
        throw new Error("Количество армий должно быть больше одной.");
    }

    const armies = createArmies(numberOfArmies);
    const game = new Game(armies);
    game.play();
} catch (error) {
    console.error(error);
}

// если введенное значение не является числом, 
// функция будет запрашивать число до тех пор, пока не будет получено корректное значение.
function promptInteger(message) {
    let value;
    do {
        value = parseInt(prompt(message));
    } while (!isNumber(value));
    return value;
}

function isNumber(num) {
	return typeof num === 'number' && !isNaN(num);
}

function createArmies(numberOfArmies) {
    const armies = [];
    for (let i = 1; i <= numberOfArmies; i++) {
        let armyName = '';
        while (!armyName) {
            armyName = prompt(`Введите имя армии ${i}:`);
        }
        const armyUnits = promptInteger(`Введите количество юнитов для армии ${i}:`);
        
        if (armyUnits <= 0) {
            throw new Error(`Количество юнитов для армии ${i} должно быть положительным числом.`);
        }

        armies.push(new Army(armyName, armyUnits));
    }
    return armies;
}