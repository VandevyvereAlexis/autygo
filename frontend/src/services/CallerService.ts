// CallerService.ts (pour les API standards)
import axios from 'axios';

const Axios = axios.create({
  baseURL: 'http://localhost:8000/api',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  withCredentials: true,
  withXSRFToken: true
});

export default Axios;