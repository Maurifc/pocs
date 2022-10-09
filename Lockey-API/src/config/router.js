const user = require('../user/routes')
const secret = require('../secret/routes')

function router(app) {
    app.get('/', (req, res) => {
        res.send('Hello World!')
    })

    app.use(
        user,
        secret
    )

}

module.exports = router