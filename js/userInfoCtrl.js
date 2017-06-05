function userInfoCtrl($mdDialog, $http, $scope) {
    var self = this;

    self.currentPage = 1;

    $http.post('php/count_user.php')
        .then(function(response) {
            self.numberOfUsers = response.data.count;
        });

    self.nextPage = function(){
        if(self.currentPage*20 < self.numberOfUsers) self.currentPage++;
        self.getUsers();
        return;
    }

    self.prevPage = function(){
        if(self.currentPage > 1) self.currentPage--;
        self.getUsers();
        return;
    }

    self.getUsers = function(){
        $http.post('php/users.php', self.currentPage).
            then(function(responce){
                self.users = responce.data;
                for(var i = 0; i < self.users.length; i++){
                    self.users[i] = self.users[i].row.slice(1, self.users[i].row.length-1).split(',');
                }
            });
    }
    self.getUsers();

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

		function dialogController($mdDialog, locals, $http) {
            var self = this;
			self.userId = locals.userId;
            self.userName = locals.userName;
            self.userSurname = locals.userSurname;

            self.options = {
                animation: true,
                responsive: false,
                maintainAspectRatio: false,
            }
            self.statistic = {
                course: {
                    num: [1,2,3,4,5],
                    count: [0,0,0,0,0]
                },
                type: {
                    id:[],
                    count:[],
                    names:[]
                },
                date: {
                    date:[],
                    count:[[]]
                }
            };

            $http.post('php/about_user.php', self.userId)
                .then(function(response) {
                    self.userInfo = response.data;
                    for(var i = 0; i < self.userInfo.length; i++){
                        if(self.userInfo[i].result){
                            var result = JSON.parse(self.userInfo[i].result)
                            for(var j = 0; j < result.course.length; j++){
                                if(result.course[j].state == true){
                                    self.statistic.course.count[j] += Math.round(result.deltaTime);
                                }
                            }
                            for(var j = 0; j < result.type.length; j++){
                                if(self.statistic.type.id.indexOf(result.type[j].id) < 0){
                                    self.statistic.type.id[self.statistic.type.id.length] = result.type[j].id;
                                    self.statistic.type.names[self.statistic.type.names.length] = result.type[j].name;
                                    self.statistic.type.count[self.statistic.type.count.length] = 0;
                                }
                                if(result.type[j].state == true){
                                    var index = self.statistic.type.names.indexOf(result.type[j].name);
                                    self.statistic.type.count[index] += Math.round(result.deltaTime);
                                }
                            }
                            var date = self.userInfo[i].start_activity.slice(0, 10);
                            if(self.statistic.date.date.indexOf(date) < 0){
                                self.statistic.date.date[self.statistic.date.date.length] = date;
                                self.statistic.date.count[0][self.statistic.date.date.indexOf(date)] = 0;
                            }
                            self.statistic.date.count[0][self.statistic.date.date.indexOf(date)] += Math.round(result.deltaTime);
                        }
                    }
                    console.log(self.statistic);
                });

			self.closeDialog = function() {
				$mdDialog.hide();
			}
		}
	}
}
