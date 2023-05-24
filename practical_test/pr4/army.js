class Army {

  #army_name;
  #army_units = [];
  #quantity_army_units;

  constructor(name, quantityArmyUnits) {
    this.#army_name = name;
    this.#quantity_army_units = quantityArmyUnits;
    this.#generateUnits(quantityArmyUnits);
  };
   
  set army_name(value) { this.#army_name = value }
  get army_name() { return this.#army_name };

  set army_units(value) { this.#army_units = value };
  get army_units() { return this.#army_units };

  set quantity_army_units(value) { this.#quantity_army_units = value };
  get quantity_army_units() { return this.#quantity_army_units };
  
  getRandUnit() {
    const randIndex = Math.floor(Math.random() * this.army_units.length);
    const randUnit = this.army_units[randIndex];
    return randUnit;
  };
  
  getSurvivorUnits() {
    const survivor_units = this.army_units
    .filter(unit => unit.status === "active")
    .map(unit => unit.name);
    if (!survivor_units.length) { return 0; }

    return survivor_units;
  };

  getDeceasedUnits() {
    const deceased_units = this.army_units
    .filter(unit => unit.status === "destroy")
    .map(unit => unit.name);
    if (!deceased_units.length) { return 0; }

    return deceased_units;
  };

  getUnitsHealth() {
    return this.army_units.reduce((totalHealth, unit) => {
      if (unit.status !== "destroy") {
        return totalHealth + unit.health;
      }
      return totalHealth;
    }, 0);
  };
  
  #generateUnits(quantityArmyUnits) {
    Array.from({ length: quantityArmyUnits }).forEach(() => {
      this.army_units.push(new Unit());
    });
  };
  
  recoveryUnits() {
    for (const unit of this.army_units) {
      unit.recovery();
    }
  };
  
  checkArmy() {
    return this.army_units.every(unit => unit.status === "destroy");
  };
}
