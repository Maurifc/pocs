require('dotenv').config()
require('./config/dbConnect')
require('./config/vault')
require('./user/authStrategies')
const express = require('express')
const router = require('./config/router')
const errorHandling = require('./errorHandling')

const app = express()

app.use(express.json())

router(app)

app.use(errorHandling)

module.exports = app