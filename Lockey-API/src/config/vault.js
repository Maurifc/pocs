const vault = require('node-vault')

module.exports = {
    getInstance: (vaultToken) => {
        const options = {
            apiVersion: 'v1',
            endpoint: process.env.VAULT_ADDR,
            token: vaultToken
        }
        
        return vault(options)
    }
}