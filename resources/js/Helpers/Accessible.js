
class Accessible{
    employeeAccessableRoute=['home','item-list','supplier-list','login','logout']
    storeExecutiveAccessableRoute=['home','item-list','supplier-list','login','logout','stock-list','receive-list','receive-create','receive-create']
    getUserAccess(route_name){
        //alert(route_name +' '+ User.getUserRole())
        if(User.getUserRole()==='Admin')
        {
            return true;
        }
        if(User.getUserRole()==='Employee'){
            return this.employeeAccessableRoute.includes(route_name);
        }
        else
        {
            return this.storeExecutiveAccessableRoute.includes(route_name);
        }
    }
    
}

export default Accessible = new Accessible()