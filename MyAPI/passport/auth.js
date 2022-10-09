const passport = require('passport')

// TODO: Improve error status code when login fails
module.exports = {
    local: (req, res, next) => {
        passport.authenticate(
            'local',
            { session: false }
        )(req, res, next)
    },

    bearer: (req, res, next) => {
        passport.authenticate(
            'bearer',
            { session: false },
            (error, user, info) => {                
                if(error && error.name === 'InvalidTokenError')
                    return res.status(401).json({ error: error.message })

                if(error)
                    return res.status(500).json({ error: error.message })

                if(error === null && user === false)
                    return res.status(401).json()
                    
                req.token = info.token
                return next()
            }
        )(req, res, next)
    }
}