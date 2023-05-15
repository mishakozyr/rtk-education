class Army {
  constructor(name, quantityArmyUnits) {
    this._army_name = name;
    this._army_units = [];
    this._quantity_army_units = quantityArmyUnits;
    this.generateUnits(quantityArmyUnits);
  }
  
  get army_name() {
    return this._army_name;
  }
  
  get army_units() {
    return this._army_units;
  }
  
  get quantity_army_units() {
    return this._quantity_army_units;
  }
  
  getRandUnit() {
    const randIndex = Math.floor(Math.random() * this._army_units.length);
    const randUnit = this._army_units[randIndex];
    return randUnit;
  }
  
  getSurvivorUnits() {
    const survivor_units = this.army_units
    .filter(unit => unit.status === "active")
    .map(unit => unit.name);
    if (survivor_units.length === 0) { return 0; }

    return survivor_units;
  }

  getDeceasedUnits() {
    const deceased_units = this.army_units
    .filter(unit => unit.status === "destroy")
    .map(unit => unit.name);
    if (deceased_units.length === 0) { return 0; }

    return deceased_units;
  }

  getUnitsHealth() {
    return this.army_units.reduce((totalHealth, unit) => {
      if (unit.status !== "destroy") {
        return totalHealth + unit.health;
      }
      return totalHealth;
    }, 0);
  }
  
  generateUnits(quantityArmyUnits) {
    Array.from({ length: quantityArmyUnits }).forEach(() => {
      this._army_units.push(new Unit());
    });
  }
  
  recoveryUnits() {
    for (const unit of this.army_units) {
      unit.recovery();
    }
  }
  
  checkArmy() {
    return this._army_units.every(unit => unit.status === "destroy");
  }
}
