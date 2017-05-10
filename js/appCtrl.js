function appCtrl($mdSidenav, $mdMenu){

    this.toogleLeftSidenav = function (){
        if($mdSidenav("left").isOpen()){
            $mdSidenav("left").close();
        }
        else{
            $mdSidenav("left").open();
        }
    }

    this.openMenu = function($mdOpenMenu, ev) {
        $mdOpenMenu(ev);
        return;
    }

    this.goToLessonsList = function(){
        return;
    }
    this.goToProfile = function(){
        return;
    }
    this.goToSettings = function(){
        return;
    }

}
