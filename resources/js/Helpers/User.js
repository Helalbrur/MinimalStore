
import AppStorage from './AppStorage';
class User{

	responseAfterLogin(res){
		const id = res.id;
		const username = res.name;
		if (id) {
			AppStorage.store(res);
		}
	}
	hasUser(){
		const user = localStorage.getItem('user');
		if (user) {
			return true;
		}
		false
	}

	loggedIn(){
		return this.hasUser()
	}

	logOut(){
		AppStorage.clear()
	}
	getUserName(){
		if (this.loggedIn()) {
			return localStorage.getItem('user');
		}
		return "";
	}
	getUserRole(){
		if (this.loggedIn()) {
			return localStorage.getItem('role');
		}
		return "";
	}

	id(){
		if (this.loggedIn()) {
			return localStorage.getItem('id');
		}
		return false
	}
	setItem(key,value)
	{
		if(localStorage.getItem(key))
		{
			localStorage.removeItem(key);
		}
		localStorage.setItem(key,value);
	}
	getItem(key){
		return localStorage.getItem(key);
	}

}

export default User = new User()