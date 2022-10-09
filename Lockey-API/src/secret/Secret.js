const vault = require('../config/vault')

function getSecretWithoutMetadata(secret){
    let newSecret = {}

    if(secret.renewable)
        newSecret = {
            secret: secret.data,
            leaseDuration: secret.lease_duration,
        }
    else
        newSecret = {
            secret: secret.data.data,
            leaseDuration: secret.lease_duration,
        }

    return newSecret
}

class Secret{
    // TODO: return ttl too
    static async get(vaultToken, path){
        const vaultInstance = vault.getInstance(vaultToken)
        const rawSecret = await vaultInstance.read(path)
        
        const secretWithoutMetada = getSecretWithoutMetadata(rawSecret)
        return secretWithoutMetada        
    }

    //TODO: Implement secret listing
    static async list(path='/secret'){
        // const list = await vault.list(path)
        return []
    }
}

module.exports = Secret