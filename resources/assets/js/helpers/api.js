import axios from 'axios'
import Auth from '../store/auth'

export function get(url) {
    return axios({
    	method: 'GET',
    	url: url,
    	headers: {
    		'Authorization': `Bearer ${Auth.state.api_token}`,
            'X-Requested-With': 'XMLHttpRequest'
    	}
    })
}

export function post(url, payload) {
    return axios({
    	method: 'POST',
    	url: url,
    	data: payload,
    	headers: {
    		'Authorization': `Bearer ${Auth.state.api_token}`,
            'X-Requested-With': 'XMLHttpRequest'
    	}
    })
}
// delete is reserved keyword
export function del(url) {
    return axios({
        method: 'DELETE',
        url: url,
        headers: {
            'Authorization': `Bearer ${Auth.state.api_token}`,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
}

export function interceptors(cb) {
    axios.interceptors.response.use((res) => {
        return res;
    }, (err) => {
        cb(err)
        return Promise.reject(err)
    })
}
