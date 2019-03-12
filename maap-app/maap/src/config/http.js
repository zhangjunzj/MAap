import Vue from 'vue'
import env from '../config/env'

const http = (path, method='POST', params) => {
	let url = env.baseUrl + path;
	let key = sessionStorage.getItem('nihao') || '';
	params = Object.assign({}, params, {key});
	return new Promise((resolve, reject)=> {
		fetch(url, {
			method: method,
			body: new URLSearchParams(params).toString(),
			headers: new Headers({
				'Accept': 'application/json',
				'Content-Type': 'application/x-www-form-urlencoded'
			})
		})
		.then((res)=>{
			return res.text();
		})
		.then((res)=> {
			let resp = JSON.parse(res);
			if (resp.code === -1) {
				Vue.Router.push('/login');
				return false;
			}
			resolve(JSON.parse(res));
			return res;
		})
		.catch((err)=> {
			reject(err);
		})
	});
}

export default http