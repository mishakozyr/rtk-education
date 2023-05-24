class Game {
    
    #armies;
    #wins = {}; // объект для хранения побед каждой армии

    constructor(armies) {
        this.#armies = armies;

        this.#play();
    }; 

    get armies() { return this.#armies };
    set wins(value) { this.#wins = value };
    get wins() { return this.#wins };

    #play() {
        let start_message = `Начало игры\n\nОбщая информация по игре:\n\n` +
        `Всего армий: ${this.#getAllArmies()}`;
        this.#log(start_message, 1);

        for (let i = 1; i <= 3; i++) {
            this.#log(`раунд - ${i}`, 1);
            this.#round();
        }

        let end_message = `Конец игры\n\nОбщая информация по игре:\n\n` +
        `${this.#displayWins()}\n\n` +
        `Итог всей игры: ${this.#getArmyWithMostWins()}`;
        this.#log(end_message, 1);
    };

    #round() {
        // console.log(this.#wins);
        
        let motion_id = 1;
        let round = true;

        while (round) {
            this.#log(`ход ${motion_id}:\n`);
    
            let attacker = this.#getRandomArmy();
            let defender = this.#getRandomArmy();

            while (attacker === defender) {
                defender = this.#getRandomArmy();
            }
    
            const attackingUnit = attacker.getRandUnit();
            const defendingUnit = defender.getRandUnit();
    
            this.#log(`Атакующий: ${attackingUnit.name}` +
                `(Здоровье: ${attackingUnit.health}, Урон: ${attackingUnit.damage}, Армия: ${attacker.army_name})`);
            this.#log(`Защищающийся: ${defendingUnit.name}` +
                `(Здоровье: ${defendingUnit.health}, Урон: ${defendingUnit.damage}, Армия: ${defender.army_name})`);
    
            attackingUnit.hit(defendingUnit);
    
            if (defender.checkArmy()) {
                let win_message = `Победила армия: "${attacker.army_name}"\n` +
                `выжившие юниты этой армии: ${attacker.getSurvivorUnits()}\n` +
                `их общее оставшееся здоровье: ${attacker.getUnitsHealth()}\n` +
                `погибшие юниты этой армии: ${attacker.getDeceasedUnits()}`;
    
                this.#log(win_message, 1);
    
                if (this.wins.hasOwnProperty(attacker.army_name)) {
                // увеличить счетчик побед для армии
                this.wins[attacker.army_name]++;
                } else {
                // установить счетчик побед для армии в 1
                this.wins[attacker.army_name] = 1;
                }
    
                this.armies.forEach((army) => {
                    army.recoveryUnits();
                });
                
                round = false;
            }
            
            motion_id++;
        }
    };

    #getRandomArmy = function() {
        const randomArmies = this.armies.filter(army => 
            !army.checkArmy());
        const randomIndex = Math.floor(Math.random() * randomArmies.length);
        const randomArmy = randomArmies[randomIndex];

        return randomArmy;
    };

    #getAllArmies() {
        let all_armies = [];
        for (const army of this.armies) {
            all_armies.push(army.army_name);
        }
        return all_armies;
    };

    #getArmyWithMostWins() {
        let maxWins = 0;
        let armies_most_wins;

        for (const armyName in this.wins) {
            const value = this.wins[armyName];
            
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

    #displayWins() {
        let wins_message = "Все победы армий:\n";

        Object.entries(this.wins).forEach(([army_name, wins]) => {
            wins_message += `${army_name}: ${wins} побед\n`;
        });

        return wins_message;
    };

    // #getRandomDefender(attacker) {
    //     const defenders = this.#armies.filter(army => army !== attacker && 
    //         !army.#checkArmy());
    //     const randomIndex = Math.floor(Math.random() * defenders.length);
    //     return defenders[randomIndex];
    // };
  
    #log(message, alert_vkl = 0) {
        if (alert_vkl === 0) {
            console.log(message);
        } else if (alert_vkl === 1) {
            console.log(message);
            alert(message);
        }
    };
}
