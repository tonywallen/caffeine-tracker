import axios from 'axios';
import AppConstant from '../constants/app';

class AuthService {

    signIn(email, password) {
        return axios
            .post(AppConstant.API_URL + '/signIn', {
                email,
                password
            })
            .then(response => {
                if (response.data.access_token) {
                    return this.setCurrentUser(response.data.access_token);
                }
            });
    }

    signUp(username, email, password) {
        return axios.post(AppConstant.API_URL + '/signUp', {
            username,
            email,
            password
        });
    }

    signOut() {
        localStorage.removeItem('user');
    }

    setCurrentUser(token) {
        return axios
            .get(AppConstant.API_URL + '/getProfile?token=' + token)
            .then(response => {
                console.log(response);
                localStorage.setItem('user', JSON.stringify(response.data.user));
            });
    }

    getCurrentUser() {
        return JSON.parse(localStorage.getItem('user'));
    }
}





export default new AuthService();