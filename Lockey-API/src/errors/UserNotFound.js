class UserNotFound extends Error{
    constructor(){
        const message = 'User not found'
        super(message)

        this.message = message
        this.name = 'UserNotFound'
    }
}

module.exports = UserNotFound