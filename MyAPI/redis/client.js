const redis = require('redis')

module.export = redis.createClient({ prefix: 'blacklist_' })