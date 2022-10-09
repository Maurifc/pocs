class IncorrectUsernameOrPasswordError extends Error{
    constructor(){
        super('Incorrect username or password')
        this.name = 'IncorrectUsernameOrPasswordError'
    }
}

module.exports = IncorrectUsernameOrPasswordError