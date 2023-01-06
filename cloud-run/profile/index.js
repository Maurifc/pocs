import axios from 'axios'
import express from 'express'

const app = express()

app.use((req, res, next) => {
  console.log(`${req.method} ${req.url}`)
  next()
})

app.get('/', async (req, res) => {
  const data = {
    api: 'profile',
    user: null
  }
  try {
    const url = `${process.env.USER_API_URL}/user/100`
    console.log(`Getting user info at ${url}`);
    const apiResponse = await axios.get(url)
  
    if(res.status !== 200) {
      console.log('Could not retrieve user info')
    }
  
    data.user = apiResponse.data
  } catch (error) {
    console.log('Fail');
  } finally {
    res.send(data)    
  }

})

app.listen(3000, () => console.log('Listening...'))