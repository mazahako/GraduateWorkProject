function userInfoCtrl($mdDialog, $http, $scope) {
    var self = this;

    self.currentPage = 1;
    self.numberOfUsers = 2;
    $http.post('php/count_user.php')
        .then(function(response) {
            self.numberOfUsers = response.data.count;
    });
    self.users = $http.post('php/users.php', self.currentPage).
        then(function(responce){
            self.users = responce.data;
            for(var i = 0; i < self.users.length; i++){
                self.users[i] = self.users[i].row.slice(1, self.users[i].row.length-1).split(',');
            }
        });

    //self.users = [{"row":"(1,Михаил,Жиленко)"},{"row":"(2,Michael,Zhylenko)"}];
    // for(var i = 0; i < self.users.length; i++){
    //     self.users[i] = self.users[i].row.slice(1, self.users[i].row.length-1).split(',');
    // }

    self.openMenu = function($mdOpenMenu, ev) {
        $mdOpenMenu(ev);
        return;
    }

	self.showAdditionInformation = function($event, user, $http) {
		var parentEl = angular.element(document.body);
		$mdDialog.show({
			parent: parentEl,
			targetEvent: $event,
			templateUrl: 'html/userInfoDialog.tmpl.html',
			locals: {
				userId: user[0],
                userName: user[1],
                userSurname: user[2]
			},
            controllerAs: 'dialogCtrl',
			controller: dialogController
		});

		function dialogController($mdDialog, locals) {
            var self = this;
			self.userId = locals.userId;
            self.userName = locals.userName;
            self.userSurname = locals.userSurname;
            $http.post('php/about_user.php', self.userId)
                .then(function(response) {
                    self.userInfo = response.data;
                });
			self.closeDialog = function() {
				$mdDialog.hide();
			}
		}
	}
}
