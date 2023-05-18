class Army {
  constructor(name, quantityArmyUnits) {
    this._army_name = name;
    this._army_units = [];
    this._quantity_army_units = quantityArmyUnits;
    this._generateUnits(quantityArmyUnits);
  };

  set army_name(value) {
    this._army_name = value;
  };
  
  get army_name() {
    return this._army_name;
  };
  
  get army_units() {
    return this._army_units;
  };
  
  get quantity_army_units() {
    return this._quantity_army_units;
  };
  
  _getRandUnit() {
    const randIndex = Math.floor(Math.random() * this._army_units.length);
    const randUnit = this._army_units[randIndex];
    return randUnit;
  };
  
  _getSurvivorUnits() {
    const survivor_units = this._army_units
    .filter(unit => unit._unit_status === "active")
    .map(unit => unit._unit_name);
    if (survivor_units.length === 0) { return 0; }

    return survivor_units;
  };

  _getDeceasedUnits() {
    const deceased_units = this._army_units
    .filter(unit => unit._unit_status === "destroy")
    .map(unit => unit._unit_name);
    if (deceased_units.length === 0) { return 0; }

    return deceased_units;
  };

  _getUnitsHealth() {
    return this._army_units.reduce((totalHealth, unit) => {
      if (unit._unit_status !== "destroy") {
        return totalHealth + unit._unit_health;
      }
      return totalHealth;
    }, 0);
  };
  
  _generateUnits(quantityArmyUnits) {
    Array.from({ length: quantityArmyUnits }).forEach(() => {
      this._army_units.push(new Unit());
    });
  };
  
  _recoveryUnits() {
    for (const unit of this._army_units) {
      unit._recovery();
    }
  };
  
  _checkArmy() {
    return this._army_units.every(unit => unit._unit_status === "destroy");
  };
}
