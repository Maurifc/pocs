const jwt = require('jsonwebtoken')
const User = require('./User')

module.exports = {
    create: (userId)  => {

        if(!userId)
            throw new Error('Invalid user id')
        
        if(!process.env.JWT_EXPIRATION)            
            throw new Error('JWT Token expiration is undefined')

        if(!process.env.JWT_SECRET)            
            throw new Error('JWT Token secret is undefined')

        const payload = {
            id: userId
        }

        const options = {
            expiresIn: process.env.JWT_EXPIRATION
        }

        const token = jwt.sign(
            payload,
            process.env.JWT_SECRET,
            options
        )

        return token
    },

    verify: async(token) => {
        const decodedPayload = jwt.verify(token, process.env.JWT_SECRET)

        const user = await User.findOne({ _id: decodedPayload.id })
        
        if(!user)
            throw new Error('Invalid Token')
        
        return user
    }
}