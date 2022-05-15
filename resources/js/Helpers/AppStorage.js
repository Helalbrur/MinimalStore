class AppStorage{
	store(user){
		localStorage.setItem('user',user.name);
		localStorage.setItem('id',user.id);
		localStorage.setItem('role',user.role);
	}
	clear(){
		localStorage.removeItem('user');
		localStorage.removeItem('id');
		localStorage.removeItem('role')
	}

}

export default AppStorage = new AppStorage();