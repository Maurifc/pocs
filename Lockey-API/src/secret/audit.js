
// Save a log with this format [DATETIME] - USER - ACTION - SECRET_PATH - RESPONSE
module.exports = (req, responseStatusCode) => {
    let userName = 'UNKNOWN'
    const reqMethod = req.method
    const reqUrl = req.originalUrl
    
    if(req.user)
        userName = req.user.username

    const currentDateTime = Date().split('GMT')[0].trim()
    const action = reqMethod + ' ' + reqUrl

    console.log(`[${currentDateTime}] ${userName} - ${action} - ${responseStatusCode}`)
}