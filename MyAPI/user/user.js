const bcrypt = require('bcrypt')
const User = require('./user.model')
const InvalidFieldError = require('../error/InvalidFieldError')
const UserNotFoundError = require('../error/UserNotFoundError')

function validate(userData){
    const field = ['userName', 'password', 'bornDate']

    field.forEach((field) => {
        const value = userData[field]

        if(typeof value !== 'string' || value.length === 0)
            throw new InvalidFieldError()
    })
}

async function encryptPassword(plainTextPassword){
    const saltRounds = 12
    return await bcrypt.hash(plainTextPassword, saltRounds)
}

module.exports = {
    list: async () => {
        return await User.findAll()
    },

    getById: async (userId) => {
        const user = await User.findByPk(userId)

        if(user === null)
            throw new UserNotFoundError()
        
        return user
    },

    getByUsername: async (userName) => {
        const user = await User.findOne({
            where: {
                userName: userName
            }
        })

        if(user === null)
            throw new UserNotFoundError()
        
        return user
    },

    create: async(userData) => {
        validate(userData)
        const passwordHash = await encryptPassword(userData.password)

        User.create({
            userName: userData.userName,
            password: passwordHash,
            bornDate: userData.bornDate,
        })
    },

    update: async (userData, userId) => {
        const user = await User.findByPk(userId)

        if(user === null)
            throw new UserNotFoundError()
            
        if(Object.keys(userData).length === 0)
            throw new InvalidFieldError()

        if(userData.password !== undefined && userData.password.length > 0){
            const passwordHash = await encryptPassword(userData.password)
            userData.password = passwordHash
        }

                    
        await User.update(userData, {
            where: {
                id: userId
            }
        })
    },

    delete: async(userId) => {
        const user = await User.findByPk(userId)
        
        if(user === null)
            throw new UserNotFoundError()

        await User.destroy({
            where: {
                id: userId 
            }
        })
    }
}