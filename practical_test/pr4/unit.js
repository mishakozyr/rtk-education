class Unit {
    constructor() {
      this._unit_health = 100;
      this._unit_damage = Unit.generateRandomNumber(5, 45);
      this._unit_status = "active";
      this._unit_name = Unit.generationName();
    }
  
    hit(defender) {
      if (this._unit_health > 0) {
        defender.health -= this._unit_damage;
        this.checkHealthStatus(defender);
      }
    }
  
    recovery() {
      if (this._unit_health < 100) {
        this._unit_health = 100;
        this._unit_status = "active";
      }
    }
  
    checkHealthStatus(defender) {
      if (defender.health < 1) {
        defender.status = "destroy";
      }
    }
  
    get health() {
      return this._unit_health;
    }
  
    set health(value) {
      this._unit_health = value;
    }
  
    get damage() {
      return this._unit_damage;
    }
  
    set damage(value) {
      this._unit_damage = value;
    }
  
    get status() {
      return this._unit_status;
    }
  
    set status(value) {
      this._unit_status = value;
    }
  
    get name() {
      return this._unit_name;
    }
  
    static generationName() {
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
    }
  
    static generateRandomNumber(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
  }