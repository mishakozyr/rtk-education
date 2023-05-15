<?php

class Snake 
{
    public $line; // линия

    function __construct($file) 
    { 
        $this->line = file_get_contents($file);
        $this->line[strpos($this->line, "-")] = ">";
        $this->CreateLine(); 
    }

    // создание линии
    function CreateLine() 
    {
        $file = fopen("line.txt", "w");
        fwrite($file, $this->line . PHP_EOL);
        fclose($file);
    }

    // кушать линию
    function eat() 
    {
        $file = fopen("line.txt", "a+");
        for ($i = strpos($this->line, ">"); $this->line[$i+1] == "-"; $i++) {
            $j = $i;
            $this->line[$j] = "*";
            $this->line[++$j] = ">";
            fwrite($file, $this->line . PHP_EOL);
        }
        fclose($file);
    }
}
