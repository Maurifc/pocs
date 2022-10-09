const passport = require('passport')
const LocalStrategy = require('passport-local').Strategy
const BearerStrategy = require('passport-http-bearer').Strategy
const bcrypt = require('bcrypt')
const jwt = require('jsonwebtoken')
const user = require('../user/user')
const IncorrectUsernameOrPasswordError = require('../error/IncorrectUsernameOrPasswordError')
const InvalidTokenError = require('../error/InvalidTokenError')
const blacklistManager = require('../redis/blacklistManager')

require('dotenv').config()

function checkUser(user){
    if( user === null )
        throw new IncorrectUsernameOrPasswordError()
}

async function compareUserPassword(password, passwordHash){
    const validPassword = await bcrypt.compare(password, passwordHash)
    
    if(!validPassword)
        throw new IncorrectUsernameOrPasswordError()
}

async function checkToken(token){
    const valid = await jwt.verify(token, process.env.SECRET)
            
    if(!valid)
        throw new InvalidTokenError()

    const isBlacklisted = await blacklistManager.verify(token)

    if(isBlacklisted)
        throw new InvalidTokenError()
}

// Try to login user: Check if sent user/passwords matches
passport.use(
    new LocalStrategy({
        usernameField: 'userName',
        passwordField: 'password',
        session: false
    }, async (inputUserName, inputPassword, done) => {
        try {
            const u = await user.getByUsername(inputUserName)
            checkUser(u) // Check if user exists
            await compareUserPassword(inputPassword, u.password) // Check if password matches
            done(null, u)
        } catch (error) {
            done(error)
        }
    })
)

// Check if token sent by user is valid
passport.use(
    new BearerStrategy(async (token, done) => {
        try {
            await checkToken(token)
            done(null, user, { token: token })
        } catch (error) {
            done(error)
        }
    })
)