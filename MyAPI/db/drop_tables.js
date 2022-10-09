const sequelize = require('./sequelize-instance')
const userModel = require('../user/user.model')

userModel.drop()
    .then(() => { console.log('Tables droped') })
    .catch(() => { console.log('Failed when droping table') })