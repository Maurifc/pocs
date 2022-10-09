const Sequelize = require('sequelize')

// TODO: Move config to .env
const instance = new Sequelize(
    'myapi', // database name
    'myapi', // user name
    'awesomepass', //pass
    {
        host: 'localhost',
        dialect: 'mariadb',
    }
)

module.exports = instance