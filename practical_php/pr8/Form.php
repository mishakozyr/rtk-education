<?php

class Form 
{
    public $name; // имя
    public $date; // дата
    public $course; // курс
    public $color; // цвет 
    public $file; // файл
    
    public function __construct() 
    {
        $this->name = $_POST["name"];
        $this->date = $_POST["date"];
        $this->course = $_POST["course"];
        $this->color = $_POST["color"];
        $this->file = $_FILES["file"];
    }

    // метод сохранения файла
    public function SaveFile() 
    {
        $color = "red";
        if (isset($_POST["send"])) {
                if (isset($_FILES["file"]) && is_uploaded_file($_FILES["file"]["tmp_name"])) {
                    $fileName = "upload/" . basename($_FILES["file"]["name"]);
                    $fromFile = $_FILES["file"]["tmp_name"];
                    if (move_uploaded_file($fromFile, $fileName)) {
                        $result = "файл загружен";
                        $color = "green";
                    } else {
                        $result = "ошибка загрузки файла";
                    }
                } else {
                    $result = "не выбран файл для загрузки на сервер";
                }
        }
        return $result ? "<div style='color: $color'>$result</div>" : ""; 
    }

    // метод удаления файла
    public function DeleteFile() 
    {
        $color = "red";
        $fileName = "upload/" . basename($_FILES["file"]["name"]);

        $home = $_SERVER['DOCUMENT_ROOT']."/";

        if (isset($_POST["send"])) {
            if (file_exists(basename($_FILES["file"]["name"]))) {
                if (@unlink($fileName)) {
                    $result = "файл удален";
                    $color = "green";
                } else {
                    $result = "ошибка удаления файла";
                }
            } else {
                $result = "файл не найден на сервере";
            }
    }
        return $result ? "<div style='color: $color'>$result</div>" : ""; 
    }
    
    // получение формы
    public function GetForm() 
    {
        echo $this->name . "<br>";
        echo $this->date . "<br>";
        echo $this->course . "<br>";
        echo $this->color . "<br>";
        print_r($this->file);
    }
}
