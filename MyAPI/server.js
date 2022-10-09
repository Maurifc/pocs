const app = require('./app') // Get app setup up on app.js file
const userRouter = require('./user/user.router') // Import routes to /user
const InvalidFieldError = require('./error/InvalidFieldError')
const UserNotFoundError = require('./error/UserNotFoundError')
const InvalidTokenError = require('./error/InvalidTokenError')
const port = 3000

// Routes
app.use('/user', userRouter) // Forward every /user route to userRouter

// Error handling middleware
app.use((error, req, res, next) => {
    let statusCode = 500

    if (error instanceof InvalidFieldError)
        statusCode = 400
    else if (error instanceof UserNotFoundError)
        statusCode = 404
    else if (error instanceof InvalidTokenError)
        statusCode = 401

    console.log(error.message);
    res.status(statusCode).json({ message: error.message })
})

app.listen(port, () => console.log('App is listening on port ' + port))