
import axios from 'axios'

const pokemonApi = axios.create({
    baseURL:'http://localhost/Proyecto%20de%20instancia/Project-ATV/public/api'
})

export default pokemonApi