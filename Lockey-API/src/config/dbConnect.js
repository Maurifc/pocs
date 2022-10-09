const mongoose = require('mongoose')

const conn = mongoose.connect('mongodb://api:api@localhost:27017/lockey-api')
                        .then(() => console.log('Connected sucessfully to mongodb'))
                        .catch(error => console.log('Failed when connectiong to mongodb: ' + error.message))


module.exports = conn