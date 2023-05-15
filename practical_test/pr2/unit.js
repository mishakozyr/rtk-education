function Unit() {
    this.unit_health = 100;
    this.unit_status = "active";

    this.generateRandomNumber = function(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };

    this.unit_damage = this.generateRandomNumber(5, 45);

    this.generationName = function() {
        const first_part = [
            "Добро", "Тихо", "Рати", "Пути", "Яро", "Госто", "Вели",
            "Свято", "Все", "Бог", "Любо", "Миро", "Свето"
        ];
    
        const end_part = [
            "жир", "мир", "бор", "слав", "полк", "мысл", "мудр",
            "слав", "волод", "дан", "мила", "зар"
        ];
    
        const randomFirstPart =
            first_part[Math.floor(Math.random() * first_part.length)];
        const randomEndPart =
            end_part[Math.floor(Math.random() * end_part.length)];

        return randomFirstPart + randomEndPart;
    };

    this.unit_name = this.generationName();
  
    this.hit = function(defender) {
        if (this.unit_health > 0) {
            defender.unit_health -= this.unit_damage;
            this.checkHealthStatus(defender);
        }
    };
  
    this.recovery = function() {
        if (this.unit_health < 100) {
            this.unit_health = 100;
            this.unit_status = "active";
        }
    };
  
    this.checkHealthStatus = function(defender) {
        if (defender.unit_health < 1) {
            defender.unit_status = "destroy";
        }
    };
}
  