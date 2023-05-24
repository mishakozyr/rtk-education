<?php

class FactorialException extends Exception
{
    private $errorCode;
    private $additionalDetails;

    public function __construct($message, $errorCode, $additionalDetails = '')
    {
        parent::__construct($message);
        $this->errorCode = $errorCode;
        $this->additionalDetails = $additionalDetails;
    }

    final public function getCustomMessage()
    {
        return "<span style='color: red;'>Ошибка вычисления факториала: " . $this->getMessage() . "</span>";
    }

    final public function getErrorCode()
    {
        return $this->errorCode;
    }

    final public function getAdditionalDetails()
    {
        if (empty($additionalDetails)) {
            return "нет доп. деталей";
        }
        return $this->additionalDetails;
    }

    final public function showError()
    {
        $errorMessage = $this->getMessage();
        $errorCode = $this->getErrorCode();
        $additionalDetails = $this->getAdditionalDetails();

        $logMessage = PHP_EOL . "<span style='color: red;'>Ошибка вычисления факториала [$errorCode]: 
        $errorMessage</span>";
        if (!$additionalDetails) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        return $logMessage;
    }

}


class FactorialNoNumberException extends FactorialException
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
        $errorCode = FactorialException::getErrorCode();
        $additionalDetails = FactorialException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления факториала [$errorCode]: $errorMessage";
        if (!empty($additionalDetails)) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('factorial_no_number_error.txt', $logMessage, FILE_APPEND);
    }
}

class FactorialNumberException extends FactorialException
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
        $errorCode = FactorialException::getErrorCode();
        $additionalDetails = FactorialException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления факториала [$errorCode]: $errorMessage";
        if (!empty($additionalDetails)) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('factorial_number_error.txt', $logMessage, FILE_APPEND);
    }
}

class NegativeNumberException extends FactorialException
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
        $errorCode = FactorialException::getErrorCode();
        $additionalDetails = FactorialException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления факториала [$errorCode]: $errorMessage";
        if (!empty($additionalDetails)) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('negative_number_error.txt', $logMessage, FILE_APPEND);
    }
}

class BigNumberException extends FactorialException
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
        $errorCode = FactorialException::getErrorCode();
        $additionalDetails = FactorialException::getAdditionalDetails();

        $logMessage = PHP_EOL . "Ошибка вычисления факториала [$errorCode]: $errorMessage";
        if (!empty($additionalDetails)) {
            $logMessage .= " Дополнительные детали: $additionalDetails";
        }

        file_put_contents('big_number_error.txt', $logMessage, FILE_APPEND);
    }
}
