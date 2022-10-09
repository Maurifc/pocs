const { Sequelize, DataTypes, Model } = require('sequelize')
const sequelize = require('../db/sequelize-instance')

const User = sequelize.define('User', {
    userName: {
        type: DataTypes.STRING,
        allowNull: false
    },
    password: {
        type: DataTypes.STRING,
        allowNull: false
    },
    bornDate: {
        type: DataTypes.DATE,
        allowNull: false
    }
}, {
    freezeTableName: true
})

module.exports = User