const jwt = require('jsonwebtoken')
const crypto = require('crypto')
// const redisClient = require('./client')
const redis = require('redis')

// Generate token hash to uniform store on redis
function genTokenHash(token){
    return crypto.createHash('sha256').update(token).digest('base64')
}

function getTokenExpirationDate(token){
    const decodedToken = jwt.verify(token, process.env.SECRET)
    return decodedToken.exp
}
            

module.exports = {
    add: async (token) => {
        const client =  redis.createClient()
        await client.connect()

        const expiresIn = getTokenExpirationDate(token)
        const tokenHash = genTokenHash(token)
        await client.set(tokenHash, '')
        await client.expireAt(tokenHash, expiresIn)
    },

    verify: async(token) => {
        const client =  redis.createClient()
        await client.connect()

        const tokenHash = genTokenHash(token)
        return client.exists(tokenHash) // Return true if token is blacklisted 
    }
}