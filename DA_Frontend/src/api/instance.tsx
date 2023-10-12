import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://localhost:3000'
    // http://localhost:8000/api'
    // http://localhost:3000
})
export default instance;