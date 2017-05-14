function disciplineListCtrl($mdDialog, $http) {
    var self = this;
    this.disciplines = $http.post('/json/disciplines.json')
    .then(function(response) {
            self.disciplines = response.data;
    });

	this.course = [1,2,3,4,5];

    this.openMenu = function($mdOpenMenu, ev) {
        $mdOpenMenu(ev);
        return;
    }

	this.showAdditionInformation = function($event, item) {
		var parentEl = angular.element(document.body);
		$mdDialog.show({
			parent: parentEl,
			targetEvent: $event,
			templateUrl: '../html/disciplineDialog.tmpl.html',
			locals: {
				willKnow: item.willKnow,
				willBeAble: item.willBeAble,
				name: item.name
			},
            controllerAs: 'DialogCtrl',
			controller: DialogController
		});

		function DialogController($mdDialog, locals) {
			this.willKnow = locals.willKnow;
			this.willBeAble = locals.willBeAble;
			this.name = locals.name;
			this.closeDialog = function() {
				$mdDialog.hide();
			}
		}
	}
}
