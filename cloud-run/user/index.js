import express from 'express'

const app = express()

app.use((req, res, next) => {
  console.log(`${req.method} ${req.url}`)
  next()
})

app.get('/', (req, res) => {
  res.send('User')
})

app.get('/user/:id', (req, res) => {
  const user = {
    id: req.params.id,
    name: 'Alucard',
    age: 200
  }
  
  res.send(user)
})

app.listen(3001, () => console.log('Listening...'))