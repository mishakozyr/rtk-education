<?php

class Unit 
{
    public $unit_health; // запас жизни юнита
    public $unit_damage; // урон юнита
    public $unit_status; // статус юнита
    public $unit_name; // имя юнита

    const MIN_UNIT_HEALTH = 1; // минимальное здоровье юнита
    const MAX_UNIT_HEALTH = 100; // максимальное здоровье юнита
    const MIN_UNIT_DAMAGE = 5; // минимальный урон юнита
    const MAX_UNIT_DAMAGE = 45; // максимальный урон юнита

    public function __construct()
    {
        $this->unit_health = self::MAX_UNIT_HEALTH;
        $this->unit_status = "active";
        $this->unit_damage = rand(self::MIN_UNIT_DAMAGE, self::MAX_UNIT_DAMAGE);
        $this->unit_name = $this->generationName();
    }
    
    // атака на другого юнита, передается защитник 
    public function hit(Unit $defender)
    {
        $defender->unit_health -= $this->unit_damage;
        $this->checkHealthStatus($defender);
    }

    // установка active статуса юниту
    public function recovery() 
    {
        $this->unit_health = self::MAX_UNIT_HEALTH;
        $this->unit_status = "active";
    }

    // установит юниту destroy если здоровье меньше минимального, передается защитник
    private function checkHealthStatus(Unit $defender)
    {
        if ($defender->unit_health < self::MIN_UNIT_HEALTH) {
            $defender->unit_status = "destroy";
        }
    }

    // генерация имени
    private function generationName() 
    {
        $first_part = [
            "Добро", "Тихо", "Рати", "Пути", "Яро", "Госто", "Вели", 
            "Свято", "Все", "Бог", "Любо", "Миро", "Свето"
        ];
        
        $end_part = [
            "жир", "мир", "бор", "слав", "полк", "мысл", "мудр", 
            "слав", "волод", "дан", "мила", "люб", "зар"
        ];

        $name = $first_part[array_rand($first_part)] . $end_part[array_rand($end_part)];

        return $name;
    }
}
