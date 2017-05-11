function appCtrl($mdSidenav, $mdMenu){

    this.toogleLeftSidenav = function (){
        if($mdSidenav("left").isOpen()){
            $mdSidenav("left").close();
        }
        else{
            $mdSidenav("left").open();
        }
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
    this.goToInfo = function(){
        return;
    }
}
