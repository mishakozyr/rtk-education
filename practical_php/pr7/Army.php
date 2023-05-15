<?php

class Army 
{
    public $army_name; // название армии
    public $army_units = []; // массив с юнитами армии
    public $quantity_army_units; // кол-во юнитов в армии

    public function __construct($name, int $quantity_army_units)
    {
        $this->army_name = $name;
        $this->quantity_army_units = $quantity_army_units;
	    $this->setUnitsArmy($quantity_army_units);
    }

    // получение рандомного юнита из массива армии
    public function getRandUnit() {
        $army_arr = $this->army_units;
        $rand_id = array_rand($army_arr, 1);
        $rand_unit = $army_arr[$rand_id];

        return $rand_unit;
    }

    // получение выживших юнитов армии, передается армия
    public static function getSurvivorUnits(Army $army) 
    {
        $res = "";

        foreach ($army->army_units as $key => $unit) {
            if ($unit->unit_status == "active") {
                $res .= "$unit->unit_name; ";
            }
        }

        return $res;
    }

    // получение суммы здоровья выживших юнитов армии, передается армия
    public static function getUnitsHealth(Army $army)
    {
        $res = 0;

        foreach ($army->army_units as $unit) {
            if ($unit->unit_status == "destroy") {
                continue;
            }
            $res += $unit->unit_health;
        }

        return $res;
    }

    // получение погибших юнитов армии, передается армия
    public static function getDeceasedUnits(Army $army) 
    {
        $res = "";

        foreach ($army->army_units as $key => $unit) {
            if ($unit->unit_status == "destroy") {
                $res .= "$unit->unit_name; ";
            }
        }

        return $res;
    }
    

    // добавление юнитов в массив юнитов армии
    private function setUnitsArmy(int $quantity_army_units) 
    {
        for ($i = 0; $i < $quantity_army_units; $i++) {
            array_push($this->army_units, new Unit());
        }
    }
	
    // атака одного юнита на другого
	public static function goAttackUnits(Unit $attacker, Unit $defender) 
    {
        // только если у двоих статус active
        if ($attacker->unit_status == "active" && $defender->unit_status == "active") {
            $attacker->hit($defender);
        }
    }

    // восстановление active статуса юнитам
    public static function recoveryUnits(Army $army) 
    {
        foreach ($army->army_units as $unit) {
            $unit->recovery();
        }
    }

    // проверка, если все юниты destroy, то true
    public function checkArmy(): bool
    {
        $res = false;

        foreach ($this->army_units as $unit) {
            $arr_unit = (array) $unit;
            $arr_units[] = $arr_unit;
        }

        $check = array_column($arr_units, "unit_status");
        $cc = count($check);

        $filter = array_filter($check, function($item) {
            return $item === "destroy";
        });
        $cf = count($filter);

        if ($cf == $cc) {
            $res = true;
        } else {
            $res = false;
        }
        
        return $res;
    }
}
