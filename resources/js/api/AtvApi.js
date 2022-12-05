
import axios from 'axios'

const pokemonApi = axios.create({
    baseURL:'http://project-atv.test/api'
})

export default pokemonApi