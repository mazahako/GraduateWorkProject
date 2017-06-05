function disciplineListCtrl($mdDialog, $http, $scope) {
    var self = this;
    $http.post('json/disciplines.json')
    .then(function(response) {
            self.disciplines = response.data;
    });

    this.showAllDisciplines = function(){
        for(var i = 0; i < self.sortParams.course.length; i++){
            self.sortParams.course[i].state = true;
        }
        for(var i = 0; i < self.sortParams.type.length; i++){
            self.sortParams.type[i].state = true;
        }
        return;
    };

    this.sortParams = {
        time: new Date(),
        deltaTime: 0,
        course: [
            {
                num: "1",
                state: true
            },
            {
                num: "2",
                state: true
            },
            {
                num: "3",
                state: true
            },
            {
                num: "4",
                state: true
            },
            {
                num: "5",
                state: true
            }
        ],
        type: [
            {
                id: "1",
                state: true,
                name: "Фундаментальные"
            },
            {
                id: "2",
                state: true,
                name: "Программирование"
            },
            {
                id: "3",
                state: true,
                name: "Гуманитарные"
            },
            {
                id: "4",
                state: true,
                name: "Связь"
            },
            {
                id: "5",
                state: true,
                name: "Радиотехника"
            },
            {
                id: "6",
                state: true,
                name: "Общеспециальные"
            },
            {
                id: "7",
                state: true,
                name: "Общетехнические"
            },
            {
                id: "8",
                state: true,
                name: "Прочие"
            }
        ]
    }

    $scope.$watch(
        function() {
            return self.sortParams.type;
        },
        function(newValue, oldValue){
            var date = new Date();
            var params = {};
            params.course = self.sortParams.course;
            params.type = oldValue;
            self.sortParams.deltaTime = (date - self.sortParams.time)/1000;
            params.deltaTime = self.sortParams.deltaTime;
            self.sortParams.time = date;

            if(self.sortParams.deltaTime > 5){
                $http.post('php/user_activity.php', params);
                console.log(params);
            }
        }, true);

    $scope.$watch(
        function() {
            return self.sortParams.course;
        },
        function(newValue, oldValue){
            var date = new Date();
            var params = {};
            params.type = self.sortParams.type;
            params.course = oldValue;

            self.sortParams.deltaTime = (date - self.sortParams.time)/1000;
            params.deltaTime = self.sortParams.deltaTime;
            self.sortParams.time = date;

            if(self.sortParams.deltaTime > 5){
                $http.post('user_activity.php', params);
                console.log(params);
            }
        }, true);

    this.openMenu = function($mdOpenMenu, ev) {
        $mdOpenMenu(ev);
        return;
    }

	this.showAdditionInformation = function($event, item) {
		var parentEl = angular.element(document.body);
		$mdDialog.show({
			parent: parentEl,
			targetEvent: $event,
			templateUrl: 'html/disciplineDialog.tmpl.html',
			locals: {
				willKnow: item.willKnow,
				willBeAble: item.willBeAble,
				name: item.name
			},
            controllerAs: 'DialogCtrl',
			controller: DialogController
		});

		function DialogController($mdDialog, locals) {
            this.favoriteIcon = {};
            this.favoriteIcon.border = "node_modules/material-design-icons/action/svg/production/ic_favorite_border_48px.svg";
            this.favoriteIcon.filled = "node_modules/material-design-icons/action/svg/production/ic_favorite_48px.svg";
            this.favoriteIcon.current = this.favoriteIcon.border;
			this.willKnow = locals.willKnow;
			this.willBeAble = locals.willBeAble;
			this.name = locals.name;
			this.closeDialog = function() {
				$mdDialog.hide();
			}
            this.likeIt = function(){
                if(this.favoriteIcon.current == this.favoriteIcon.border){
                    this.favoriteIcon.current = this.favoriteIcon.filled;
                }
                else{
                    this.favoriteIcon.current = this.favoriteIcon.border;
                }
            }
		}
	}
}
