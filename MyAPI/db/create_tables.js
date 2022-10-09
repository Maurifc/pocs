const userModel = require('../user/user.model')

userModel.sync() // Create table for every model registered on sequelize instance
    .then(() => { console.log('Table created') })
    .catch(() => { console.log('Failed when creating table') })