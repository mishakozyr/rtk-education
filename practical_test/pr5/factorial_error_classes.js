class FactorialNumberException extends Error 
{
    constructor(message, errorCode, additionalDetails = '') 
    {
        super(message);
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

    showAlert() {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let alertMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            alertMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        alert(alertMessage);
    }

    logError() 
    {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let logMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        console.log(logMessage);
    }
}

class NegativeNumberException extends Error 
{
    constructor(message, errorCode, additionalDetails = '') 
    {
        super(message);
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

    showAlert() {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let alertMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            alertMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        alert(alertMessage);
    }

    logError() 
    {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let logMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        console.log(logMessage);
    }
}

class BigNumberException extends Error 
{
    constructor(message, errorCode, additionalDetails = '') 
    {
        super(message);
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

    showAlert() {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let alertMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            alertMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        alert(alertMessage);
    }

    logError() 
    {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let logMessage = `Ошибка вычисления факториала [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        console.log(logMessage);
    }
}
