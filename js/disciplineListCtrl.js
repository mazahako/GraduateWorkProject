function disciplineListCtrl($mdDialog, $http) {
    var self = this;
    this.disciplines = $http.post('json/disciplines.json')
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
