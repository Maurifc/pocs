import axios from 'axios'
import express from 'express'

const app = express()

app.get('/', async (req, res) => {
  const data = {
    api: 'profile',
    user: null
  }
  try {    
    const apiResponse = await axios.get(`${process.env.USER_API_URL}/user/100`)
  
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