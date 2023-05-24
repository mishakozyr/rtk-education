class Unit { 

  #unit_health;
  #unit_damage;
  #unit_status;
  #unit_name;

  constructor()
  {
    this.#unit_health = 100;
    this.#unit_damage = this.#generateRandomNumber(5, 45);
    this.#unit_status = "active";
    this.#unit_name = this.#generationName();
  }
  
  set health(value) { this.#unit_health = value }
  get health() { return this.#unit_health };

  set damage(value) { this.#unit_damage = value }
  get damage() { return this.#unit_damage };
  
  set status(value) { this.#unit_status = value }
  get status() { return this.#unit_status };
  
  set name(value) { this.#unit_name = value }
  get name() { return this.#unit_name };

  hit(defender) {
    if (this.health > 0) {
      defender.health -= this.damage;
      this.#checkHealthStatus(defender);
    }
  };

  recovery() {
    if (this.health < 100) {
      this.health = 100;
      this.status = "active";
    }
  };

  #checkHealthStatus(defender) {
    if (defender.health < 1) {
      defender.status = "destroy";
    }
  };

  #generationName() {
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
  
  #generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  };
}