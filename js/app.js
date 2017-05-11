(function(){
    var app = angular.module("MyApp", ['ngMaterial', "ui.router"]);
    app.filter("courseFilter", courseFilter);
    app.controller("disciplineListCtrl", disciplineListCtrl);
    app.controller("appCtrl", appCtrl);
    app.config(function($stateProvider, $urlRouterProvider){
        $urlRouterProvider.otherwise("/list");
        $stateProvider
        .state('list', {
            url: "/list",
            templateUrl: "html/list.tmpl.html",
            controllerAs: 'discCtrl',
            controller: 'disciplineListCtrl'
        })
        .state('info', {
            url: "/info",
            templateUrl: "html/info.tmpl.html",
            controller: function($scope){
              $scope.items = ["A", "List", "Of", "Items"];
            }
        })
        .state('settings', {
            url: "/settings",
            templateUrl: "html/settings.tmpl.html",
            controller: function($scope){
              $scope.items = ["A", "List", "Of", "Items"];
            }
        })
        .state('profile', {
            url: "/profile",
            templateUrl: "html/profile.tmpl.html",
            controller: function($scope){
              $scope.items = ["A", "List", "Of", "Items"];
            }
        })
    });
})();
