function mapCtrl(){
    this.showMap = [
        true, false, false
    ]
    this.switchMap = function(num){
        for(var i = 0; i < this.showMap.length; i++){
            this.showMap[i] = false;
        }
        this.showMap[num] = true;
    }
}
