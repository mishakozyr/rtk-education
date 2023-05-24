class QuadraticExceptions extends Error 
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
        return "Ошибка вычисления квадратного уравнения: " + this.message;
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

        let logMessage = `Ошибка вычисления квадратного уравнения [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        alert(logMessage);
        console.log(logMessage);
    }

}


class InvalidQuadraticArgumentException extends QuadraticExceptions 
{

    constructor(message, errorCode, additionalDetails = '') 
    { 
        super(message, errorCode, additionalDetails = '');
    }

}

class ZeroCoefficientException extends QuadraticExceptions 
{
    
    constructor(message, errorCode, additionalDetails = '') 
    { 
        super(message, errorCode, additionalDetails = '');
    }

}

class NoQuadraticArgumentException extends QuadraticExceptions 
{
    
    constructor(message, errorCode, additionalDetails = '') 
    { 
        super(message, errorCode, additionalDetails = '');
    }
    
}
