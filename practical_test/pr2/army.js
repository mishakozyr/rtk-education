function Army(name, quantityArmyUnits) {
    this.army_name = name;
    this.army_units = [];
    this.quantity_army_units = quantityArmyUnits;
    
    this.generateUnits = function(quantityArmyUnits) {
        Array.from({ length: quantityArmyUnits }).forEach(() => {
            this.army_units.push(new Unit());
        });
    };
      
    this.generateUnits(quantityArmyUnits);
  
    this.getRandUnit = function() {
        const randIndex = Math.floor(Math.random() * this.army_units.length);
        const randUnit = this.army_units[randIndex];
        return randUnit;
      };
  
    this.getSurvivorUnits = function() {
        const survivor_units = this.army_units
            .filter(unit => unit.unit_status === "active")
            .map(unit => unit.unit_name);
        if (survivor_units.length === 0) {
            return 0;
        }
    
        return survivor_units;
    };
  
    this.getDeceasedUnits = function() {
        const deceased_units = this.army_units
            .filter(unit => unit.unit_status === "destroy")
            .map(unit => unit.unit_name);
        if (deceased_units.length === 0) {
            return 0;
        }
    
        return deceased_units;
    };
  
    this.getUnitsHealth = function() {
        return this.army_units.reduce((totalHealth, unit) => {
            if (unit.unit_status !== "destroy") {
            return totalHealth + unit.unit_health;
            }
            return totalHealth;
        }, 0);
    };
  
    this.recoveryUnits = function() {
        for (const unit of this.army_units) {
            unit.recovery();
        }
    };
  
    this.checkArmy = function() {
        return this.army_units.every(unit => unit.unit_status === "destroy");
    };
}
  