<?php

class CountException extends Exception
{

    private $errorCode;
    private $additionalDetails;

    // конструктор принимает сообщение ошибки, код ошибки и доп. детали
    public function __construct($message, $errorCode, $additionalDetails = '')
    {

        parent::__construct($message);
        $this->errorCode = $errorCode;
        $this->additionalDetails = $additionalDetails;

    }

    public function getCustomMessage()
    {

        return "<span style='color: red;'>Ошибка нахождения строки в строке: " . 
        $this->getMessage() . "</span>";

    }

    public function getErrorCode()
    {

        return $this->errorCode;

    }

    public function getAdditionalDetails()
    {

        if (empty($additionalDetails)) {

            return "нет доп. деталей";

        }

        return $this->additionalDetails;

    }

    public function showError()
    {

        $errorMessage = $this->getMessage();
        $errorCode = $this->getErrorCode();
        $additionalDetails = $this->getAdditionalDetails();
 
        $logMessage = PHP_EOL . 
        "<span style='color: red;'>Ошибка нахождения строки в строке [$errorCode]: 
        $errorMessage</span>";

        if (!$additionalDetails) {

            $logMessage .= " Дополнительные детали: $additionalDetails";

        }

        return $logMessage;

    }

}

class StringException extends CountException 
{

    // конструктор принимает сообщение ошибки, код ошибки и доп. детали
    public function __construct($message, $errorCode, $additionalDetails = '')
    {

        parent::__construct($message, $errorCode, $additionalDetails = '');

    }

    public function logError()
    {

        // запись информации об ошибке в лог-файл
        $errorMessage = $this->getMessage();
        $errorCode = CountException::getErrorCode();
        $additionalDetails = CountException::getAdditionalDetails();

        $logMessage = PHP_EOL . 
        "Ошибка нахождения строки в строке [$errorCode]: $errorMessage";

        if (!$additionalDetails) {

            $logMessage .= " Дополнительные детали: $additionalDetails";

        }

        file_put_contents('no_string_error.txt', $logMessage, FILE_APPEND);

    }

}

function count_occurrences($string1, $string2)
{

    if (!$string1 || $string1 === null) {

        throw new StringException
        ("Не передана первая строка", 2);

    } elseif (!$string2 || $string2 === null) {

        throw new StringException
        ("Не передана вторая строка", 3);

    } elseif (!is_string($string1) || !is_string($string2)) {

        throw new StringException
        ("Аргументы должны быть строками", 1);

    } else {

        return substr_count($string1, $string2);
    
    }

}

$arr = [
    ['Hello world', '00'],
    ['aaaaaaa', 'aa'],
    ['JavaScript', 'PHP'],
    ['123', 123],
    ['Hello world', ''],
    ['', 'test'],
    [null, 'test'],
    ['aaa', 'a'],
];

foreach($arr as $el) {

    $str1 = $el[0];
    $str2 = $el[1];

    echo "$str1 $str2 <br>";

    try { 
            
        $count = count_occurrences($str1, $str2);

        echo "<span class='message'>Число вхождений строки \"$str2\" в строку \"$str1\": $count<span><br>";

    } catch (StringException $e) { 
        
        echo "<span class='error-message'>Ошибка: " . $e->getMessage() . "<span><br>";

    } catch (Exception $e) {

        echo "<span class='error-message'>Неизвестная ошибка: " . $e->getMessage() . "<span><br>";

    }

}