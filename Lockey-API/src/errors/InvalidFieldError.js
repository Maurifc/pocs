class InvalidFieldError extends Error {
    constructor(message='Field is empty or invalid'){
        super(message)

        this.message = message
        this.name = 'InvalidFieldError'
    }
}

module.exports = InvalidFieldError