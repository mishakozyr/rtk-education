class Game {
    constructor(armies) {
        this._armies = armies;
        this._wins = {}; // объект для хранения побед каждой армии

        this._play();
    };

    get armies() {
        return this._armies;
    };

    get _wins() {
        return this._wins;
    };

    _play() {
        let start_message = `Начало игры\n\nОбщая информация по игре:\n\n` +
        `Всего армий: ${this._getAllArmies()}`;
        this._log(start_message, 1);

        for (let i = 1; i <= 3; i++) {
            this._log(`раунд - ${i}`, 1);
            this._round();
        }

        let end_message = `Конец игры\n\nОбщая информация по игре:\n\n` +
        `${this._displayWins()}\n\n` +
        `Итог всей игры: ${this._getArmyWithMostWins()}`;
        this._log(end_message, 1);
    };

    _round() {
        // console.log(this._wins);
        
        let motion_id = 1;
        let round = true;

        while (round) {
            this._log(`ход ${motion_id}:\n`);
    
            let attacker = this._getRandomArmy();
            let defender = this._getRandomArmy();

            while (attacker === defender) {
                defender = this._getRandomArmy();
            }
    
            const attackingUnit = attacker._getRandUnit();
            const defendingUnit = defender._getRandUnit();
    
            this._log(`Атакующий: ${attackingUnit._unit_name}` +
                `(Здоровье: ${attackingUnit._unit_health}, Урон: ${attackingUnit._unit_damage}, Армия: ${attacker._army_name})`);
            this._log(`Защищающийся: ${defendingUnit._unit_name}` +
                `(Здоровье: ${defendingUnit._unit_health}, Урон: ${defendingUnit._unit_damage}, Армия: ${defender._army_name})`);
    
            attackingUnit._hit(defendingUnit);
    
            if (defender._checkArmy()) {
                let win_message = `Победила армия: "${attacker._army_name}"\n` +
                `выжившие юниты этой армии: ${attacker._getSurvivorUnits()}\n` +
                `их общее оставшееся здоровье: ${attacker._getUnitsHealth()}\n` +
                `погибшие юниты этой армии: ${attacker._getDeceasedUnits()}`;
    
                this._log(win_message, 1);
    
                if (this._wins.hasOwnProperty(attacker._army_name)) {
                // увеличить счетчик побед для армии
                this._wins[attacker._army_name]++;
                } else {
                // установить счетчик побед для армии в 1
                this._wins[attacker._army_name] = 1;
                }
    
                this._armies.forEach((army) => {
                    army._recoveryUnits();
                });
                
                round = false;
            }
            
            motion_id++;
        }
    };

    _getRandomArmy = function() {
        const randomArmies = this._armies.filter(army => 
            !army._checkArmy());
        const randomIndex = Math.floor(Math.random() * randomArmies.length);
        const randomArmy = randomArmies[randomIndex];

        return randomArmy;
    };

    _getAllArmies() {
        let all_armies = [];
        for (const army of this._armies) {
            all_armies.push(army._army_name);
        }
        return all_armies;
    };

    _getArmyWithMostWins() {
        let maxWins = 0;
        let armies_most_wins;

        for (const armyName in this._wins) {
            const value = this._wins[armyName];
            
            if (value > maxWins) {
                maxWins = value;
                armies_most_wins = [armyName];
            } else if (value === maxWins) {
                armies_most_wins.push(armyName);
            }
        }

        if (armies_most_wins.length === 1) {
            // возвращаем имя армии с наибольшим количеством побед
            return "победила " + armies_most_wins[0]; 
          } else {
            // если у всех одиннаковое количество побед
            return "ничья"; 
          }
    };

    _displayWins() {
        let wins_message = "Все победы армий:\n";

        Object.entries(this._wins).forEach(([army_name, wins]) => {
            wins_message += `${army_name}: ${wins} побед\n`;
        });

        return wins_message;
    };

    _getRandomDefender(attacker) {
        const defenders = this._armies.filter(army => army !== attacker && 
            !army._checkArmy());
        const randomIndex = Math.floor(Math.random() * defenders.length);
        return defenders[randomIndex];
    };
  
    _log(message, alert_vkl = 0) {
        if (alert_vkl === 0) {
            console.log(message);
        } else if (alert_vkl === 1) {
            console.log(message);
            alert(message);
        }
    };
}
