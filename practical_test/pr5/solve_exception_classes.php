<?php

class QuadraticException extends Exception 
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
        return "<span style='color: red;'>Ошибка вычисления квадратного уравнения: " . $this->getMessage() . "</span>";
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
 
        $logMessage = PHP_EOL . "<span style='color: red;'>Ошибка вычисления квадратного уравнения [$errorCode]: 
        $errorMessage</span>";
        if (!$additionalDetails) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        return $logMessage;
    }

}


class InvalidQuadraticArgumentException extends QuadraticException 
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
        $errorCode = QuadraticException::getErrorCode();
        $additionalDetails = QuadraticException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления квадратного уравнения [$errorCode]: $errorMessage";
        if (!$additionalDetails) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('invalid_argument_error.txt', $logMessage, FILE_APPEND);
    }

} 

class ZeroCoefficientException extends QuadraticException 
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
        $errorCode = QuadraticException::getErrorCode();
        $additionalDetails = QuadraticException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления квадратного уравнения [$errorCode]: $errorMessage";
        if (!$additionalDetails) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('zero_argument_error.txt', $logMessage, FILE_APPEND);
    }
}

class NoQuadraticArgumentException extends QuadraticException
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
        $errorCode = QuadraticException::getErrorCode(); 
        $additionalDetails = QuadraticException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления факториала [$errorCode]: $errorMessage";
        if (!empty($additionalDetails)) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('no_argument_error.txt', $logMessage, FILE_APPEND);
    }
}
