(function() {
	var app = angular.module("AuthApp", ['ngMaterial']);
	app.config(function($mdThemingProvider) {
		$mdThemingProvider.theme('altTheme')
			.primaryPalette('indigo')
        $mdThemingProvider.theme('default')
			.primaryPalette('teal')
	});
})();
