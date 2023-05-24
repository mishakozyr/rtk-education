class ValidateFactorialException extends Error 
{

    constructor(message, errorCode, additionalDetails = '') 
    {

        super(message);
        this.name = this.constructor.name;
        
        this.errorCode = errorCode;
        this.additionalDetails = additionalDetails;

    }

    getCustomMessage() 
    {

        return "Ошибка вычисления факториала: " + this.message;
    
    }

    getErrorCode() 
    {

        return this.errorCode;
    
    }

    getAdditionalDetails() 
    {

        if (!this.additionalDetails) {

            return "нет доп. деталей";

        }

        return this.additionalDetails;

    }

    logError() 
    {

        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let logMessage = 
        `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;

        if (additionalDetails) {

            logMessage += 
            ` Дополнительные детали: ${additionalDetails}`;

        }

        alert(logMessage)
        console.log(logMessage);

    }

} 

class NumberException extends ValidateFactorialException 
{

    constructor(message, errorCode, additionalDetails = '') 
    {

        super(message, errorCode, additionalDetails = '');

    }

}

class NegativeNumberException extends ValidateFactorialException 
{

    constructor(message, errorCode, additionalDetails = '') 
    {

        super(message, errorCode, additionalDetails = '');

    }

}

class BigNumberException extends ValidateFactorialException 
{

    constructor(message, errorCode, additionalDetails = '') 
    {

        super(message, errorCode, additionalDetails = '');

    }

}

class NoNumberException extends ValidateFactorialException 
{

    constructor(message, errorCode, additionalDetails = '') 
    {

        super(message, errorCode, additionalDetails = '');

    }

} 
