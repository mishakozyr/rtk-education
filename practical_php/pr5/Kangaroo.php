<?php
class Kangaroo 
{
    public $name; // имя
    public $legs; // ноги
    public $arms; // руки
    public $children; // дети
    public $energy; // энергия
    public $endurance; // выносливость

    public function __construct($name) 
    {
        $this->name = $name;
        $this->legs = 2;
        $this->arms = 2;
        $this->children = 0;

        $this->energy = 10;
        $this->endurance = 10;
    }

    // получение выносливости
    public function getEndurance() 
    {
        $endurance = $this->endurance;
        return "$endurance выносливости<br>";
    }

    // получение энергии
    public function getEnergy() 
    {
        $energy = $this->energy;
        return "$energy энергии<br>";
    }

    // получение имени
    public function getName() 
    {
        $name = $this->name;
        return "кенгуру по имени $name<br>";
    }

    // бег
    public function run() 
    {
        $name = $this->name;
        $energy = $this->energy;
        $energyRun = 15;
        $endurance = $this->endurance;
        $endurancePlus = 2;

        // бежит если энергия больше 0 и ног больше 0
        if ($this->energy > 0 && $this->legs > 0) {
            echo "кенгуру по имени $name вышел на пробежку<br>";
            $this->energy = $energy - $energyRun;
            $this->endurance = $endurance + $endurancePlus;
            echo "кенгуру по имени $name закончил пробежку, прокачал свою выносливость на 
            $endurancePlus и потратил: $energyRun энергии<br>";
        } else {
            echo "кенгуру по имени $name устал, ему нужно поспать<br>";
        }
    }

    // удар
    public function hit() 
    {
        $name = $this->name;
        $energy = $this->energy;
        $energyHit = 20;
        $endurance = $this->endurance;
        $endurancePlus = 3;

        // бьет если энергия больше 0 и ног больше 0
        if ($this->energy > 0 && $this->arms > 0) {
            echo "кенгуру по имени $name начал бить грушу<br>";
            $this->energy = $energy - $energyHit;
            $this->endurance = $endurance + $endurancePlus;
            echo "кенгуру по имени $name закончил бить грушу, прокачал свою выносливость на 
            $endurancePlus и потратил: $energyHit энергии<br>";
        } else {
            echo "кенгуру по имени $name устал, ему нужно поспать<br>";
        }
    }

    // сон
    public function sleep() 
    {
        // если энергия <= 0 то спит
        if ($this->energy <= 0) {
            $this->energy = 30;

        // если другое количесво то += 30% 
        } else { 
            $this->energy = $this->energy + $this->energy / 100 * 30;
            round($this->energy); 
        }
        if ($this->energy > 100) {
            $this->energy = 100;
        }
    }

    // прыжок
    public function jump ()
    {
        $name = $this->name;
        $energy = $this->energy;
        $energyJump = 20;

        if ($this->energy >= 100) {
            $this->energy = $energy - $energyJump;
            echo "кенгуру по имени $name прыгнул и потратил: $energyJump энергии<br>";
        } else {
            while ($this->energy < 30) {
                $this->sleep ();
                echo "кенгуру по имени $name устал чтобы прыгать, ему нужно поспать<br>";
            }
            $this->energy = $energy - $energyJump;
            echo "кенгуру по имени $name прыгнул и потратил: $energyJump энергии<br>";
        }
    }

    // получение детей
    public function getChildren() 
    {
        $name = $this->name;
        return "у кенгуру по имени $name вот столько детей: " . $this->children . "<br>";
    }

    // добавление детей
    public function addChildren($child) 
    {
        $children = $this->children;
        if (is_int($child)) {
            $this->children = $children + $child;
        }
    }
}
