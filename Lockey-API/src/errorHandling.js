const JsonWebTokenError = require('jsonwebtoken').JsonWebTokenError
const CastError = require('mongoose').CastError
const audit = require('./secret/audit')

module.exports = (error, req, res, next) => {
    let errorStatus = 500
    let message = error.message

    switch (error.name) {
        case 'JsonWebTokenError':
            errorStatus = 401
            break;

        case 'CastError':
            message = 'Invalid user id'
            errorStatus = 400
            break
        
        case 'ValidationError':
            errorStatus = 400
            break

        case 'InvalidFieldError':
            errorStatus = 400
            break
    }

    audit(req, errorStatus)
    
    res.status(errorStatus).send({ message: message })
    next()
}