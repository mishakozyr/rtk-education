<?php

class Game
{
    public $armies; // массив с армиями
    public $army_one = []; // первая армия
    public $army_two = []; // вторая армия

    const ROUNDS = 3; // количество раундов
    const LOG_FILE = "log.txt"; // файл логирования

    public function __construct(array $armies)
    {
        self::log("", FILE_NO_DEFAULT_CONTEXT);
        $this->armies = $armies;
        $this->army_one = $armies[0];
        $this->army_two = $armies[1];
        $this->play();
    }

    // начало игры
    public function play()
    {
        $start_game_text = "Начало игры\n";
        self::log($start_game_text);
        // цикл раундов
        for ($i = 1; $i < (self::ROUNDS + 1); $i++) {

            $round_number = "\nраунд - $i\n\n";
            self::log($round_number);

            $this->round();
            // пока $i не равно количеству раундов игра продолжается 
            if ($i != (self::ROUNDS)) {
                $new_line = "\n";
                self::log($new_line);
            } else {
                $end_game_text = "\n\nКонец игры\n";
                self::log($end_game_text);
            }
        }
    }

    // один раунд
    public function round()
    {
        $motion_id = 1;
        $round = true;
        
        // раунд продолжается пока все юниты одной армии не будут destroy
        while ($round) {
            $motion_text = "ход $motion_id: \n";
            self::log($motion_text);

            $first_army = $this->army_one; // первая армия
            $second_army = $this->army_two; // вторая армия
            $first_rand_unit = $first_army->getRandUnit(); // рандомный юнит первой армии
            $second_rand_unit = $second_army->getRandUnit(); // рандомный юнит второй армии
            
            Army::goAttackUnits($first_rand_unit, $second_rand_unit); // атака
            // текст хода
            $attack_text_one = "юнит армии: " . $first_army->army_name . ", по имени: " . 
            $first_rand_unit->unit_name . " хитнул юнита из армии: ". $second_army->army_name . 
            " по имени: " . $second_rand_unit->unit_name . " и нанес ему " . 
            $first_rand_unit->unit_damage . " урона\n";
            self::log($attack_text_one);

            Army::goAttackUnits($second_rand_unit, $first_rand_unit); // атака
            // текст хода
            $attack_text_two = "юнит армии: " . $second_army->army_name . ", по имени: " . 
            $second_rand_unit->unit_name . " хитнул юнита из армии: ". $first_army->army_name . 
            " по имени: " . $first_rand_unit->unit_name . " и нанес ему " . 
            $second_rand_unit->unit_damage . " урона\n";
            self::log($attack_text_two);

            // checkArmy() возвращает true если все юниты destroy
            if ($second_army->checkArmy()) {
                $victory = "\nпобедила " . $this->army_one->army_name;
                self::log($victory);

                $survivor = "\nвыжившие юниты: " . 
                (Army::getSurvivorUnits($this->army_one)) .
                "их общее оставшееся здоровье: " . 
                (Army::getUnitsHealth($this->army_one));
                self::log($survivor);

                $deceased = "\nпогибшие юниты: " . 
                (Army::getDeceasedUnits($this->army_two));
                self::log($deceased); 

                // восстановление здоровья и статуса юнитов двух армий
                Army::recoveryUnits($this->army_one);
                Army::recoveryUnits($this->army_two);
                break;

            // checkArmy() возвращает true если все юниты destroy
            } elseif ($this->army_one->checkArmy()) {
                $victory = "\nпобедила " . 
                $this->army_two->army_name;
                self::log($victory);

                $survivor = "\nвыжившие юниты: " . 
                (Army::getSurvivorUnits($this->army_two)) .
                "их общее оставшееся здоровье: " . 
                (Army::getUnitsHealth($this->army_two));
                self::log($survivor);

                $deceased = "\nпогибшие юниты: " . 
                (Army::getDeceasedUnits($this->army_one));
                self::log($deceased);

                // восстановление здоровья и статуса юнитов двух армий
                Army::recoveryUnits($this->army_one);
                Army::recoveryUnits($this->army_two);
                break;
            }
            // счетчик хода
            $motion_id++;
        }
    }

    // метод логирования 
    // FILE_APPEND - флаг для записывания в конец файла
    public static function log($text, $mode = FILE_APPEND)
    {
        $log_file = self::LOG_FILE;
        file_put_contents($log_file, $text, $mode);
    }
}
