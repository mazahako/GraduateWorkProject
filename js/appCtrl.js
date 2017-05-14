function appCtrl($mdSidenav){

    this.toogleLeftSidenav = function (){
        self.lol = $mdSidenav("left").isOpen();
        if($mdSidenav("left").isOpen()){
            $mdSidenav("left").close();
        }
        else{
            $mdSidenav("left").open();
        }
    }
}
