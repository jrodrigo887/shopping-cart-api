import axios from 'axios';
import qs from 'qs';

const baseURL = import.meta.env.VITE_BASE_URL ?? '';

const http = axios.create({
    baseURL,
    paramsSerializer: params => qs.stringify(params)

})

export default http;
