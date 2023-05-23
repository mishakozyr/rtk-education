class InvalidQuadraticArgumentException extends Error 
{
    constructor(message, errorCode, additionalDetails = '') 
    {
        super(message);
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

    showAlert() {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let alertMessage = `Ошибка вычисления квадратного уравнения [${errorCode}]: ${errorMessage}`;
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

        let logMessage = `Ошибка вычисления квадратного уравнения [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        console.log(logMessage);
    }
}

class ZeroCoefficientException extends Error 
{
    constructor(message, errorCode, additionalDetails = '') 
    {
        super(message);
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

    showAlert() {
        const errorMessage = this.message;
        const errorCode = this.errorCode;
        const additionalDetails = this.additionalDetails;

        let alertMessage = `Ошибка вычисления квадратного уравнения [${errorCode}]: ${errorMessage}`;
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

        let logMessage = `Ошибка вычисления квадратного уравнения [${errorCode}]: ${errorMessage}`;
        if (additionalDetails) {
            logMessage += ` Дополнительные детали: ${additionalDetails}`;
        }

        console.log(logMessage);
    }
}
