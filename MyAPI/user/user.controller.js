const jwt = require('jsonwebtoken')
const user = require('./user.js')
const blacklistManager = require('../redis/blacklistManager')
require('dotenv').config()

module.exports = {
    login: (req, res) => {
        const payload = { id: req.user.id } // Injected on LocalStrategy setup
        const secret = process.env.SECRET // get SECRET from .env file
        const expiration = { expiresIn: '10m'}

        const token = jwt.sign(payload, secret, expiration)

        res.set('Authorization', token) // Set header 'Authorization' with the login token
        res.status(204).send()
    },

    logout: async(req, res, next) => {
        try {
            const token = req.token

            await blacklistManager.add(token)

            res.send()
        } catch (error) {
            next(error)
        }
    },
    
    list: async (req, res) => {
        const users = await user.list()
        
        res.status(200)
        res.json(users)
    },

    getUserById: async(req, res, next) => {
        try {
            const userId = req.params.userId
            const u = await user.getById(userId)

            res.json(u)
        } catch (error) {
            next(error)
        }
    },

    create: async (req, res, next) => {
        try {
            const data = req.body
            await user.create(data)          
    
            res.status(201).send()            
        } catch (error) {
            next(error)
        }
    },

    update: async (req, res, next) => {
        try {
            const userId = req.params.userId
            const data = req.body
            
            await user.update(data, userId)

            res.status(204).send()
        } catch (error) {
            next(error)
        }
    },

    delete: async(req, res, next) => {
        try {
            const userId = req.params.userId
    
            await user.delete(userId)
    
            res.status(204).send()            
        } catch (error) {
            next(error)
        }
    }
}