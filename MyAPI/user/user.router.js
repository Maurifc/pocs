const router = require('express').Router()
const userController = require('./user.controller')
const auth = require('../passport/auth')
const app = require('../app')

router.get('/', auth.bearer, userController.list)
router.get('/:userId', auth.bearer, userController.getUserById)
router.post('/', auth.bearer, userController.create)
router.put('/:userId', auth.bearer, userController.update)
router.delete('/:userId', auth.bearer, userController.delete)
router.post('/login', auth.local, userController.login)
router.post('/logout', auth.bearer, userController.logout)

module.exports = router