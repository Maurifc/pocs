const router = require('express').Router()
const SecretController = require('./SecretController')
const passport = require('passport')

router
    .get('/secret/*', passport.authenticate('bearer', { session: false }), SecretController.getByPath)
    .get('/secret', passport.authenticate('bearer', { session: false }), SecretController.list)

module.exports = router