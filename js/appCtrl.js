function appCtrl($mdSidenav){
    this.toogleLeftSidenav = function (){
        if($mdSidenav("left").isOpen()){
            $mdSidenav("left").close();
        }
        else{
            $mdSidenav("left").open();
        }
    }
}
