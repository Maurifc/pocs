class UserNotFoundError extends Error{
    constructor(){
        super("User cannot be found!")
        this.name = 'UserNotFoundError'
    }
}

module.exports = UserNotFoundError