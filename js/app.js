(function(){
    var app = angular.module("MyApp", ['ngMaterial']);
    app.filter("courseFilter", courseFilter);
    app.controller("disciplineListCtrl", disciplineListCtrl);
    app.controller("appCtrl", appCtrl);
})();