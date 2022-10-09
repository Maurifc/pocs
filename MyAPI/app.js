// App Setup
const express = require('express')
const bodyParser = require('body-parser')
const authStrategy = require('./passport/strategy')
require('./redis/client')

const app = express() // Create app from express
app.use(bodyParser.json()) // Include body parser
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

module.exports = app // Exports