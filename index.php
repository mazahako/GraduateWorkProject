<?php
if (!isset($_SESSION))session_start();
if (isset($_GET['do']) && $_GET['do']=='logout') {
    unset($_SESSION['user']);
    session_destroy();
}
if (!$_SESSION['user']) {
    header("Location: auth.php");
    exit();
}?>

<!DOCTYPE html>
<html lang="en" ng-app="MyApp" ng-controller="appCtrl as app" >

<head>
	<meta charset="UTF-8">
	<title>K504</title>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

</head>

<body layout="row" layout-fill>
	<md-sidenav class="md-sidenav-left" layout="column" md-component-id="left" md-whiteframe="4" md-is-locked-open="$mdMedia('gt-md')">
		<md-toolbar class="md-tall" layout="row">
			<div class="md-toolbar-tools">
				<h2 flex>Навигация</h2>

				<md-button class="md-icon-button" ng-click="app.toogleLeftSidenav()" hide-gt-md aria-label="More">
					<md-icon md-svg-icon="node_modules/material-design-icons/navigation/svg/production/ic_arrow_back_48px.svg"></md-icon>
				</md-button>
			</div>
		</md-toolbar>
		<md-content>
			<md-list>
                <md-list-item ui-sref="info">
					<md-icon md-svg-icon="node_modules/material-design-icons/action/svg/production/ic_info_48px.svg"></md-icon>
					<p>О специальности</p>
				</md-list-item>
				<md-list-item ui-sref="list">
					<md-icon md-svg-icon="node_modules/material-design-icons/action/svg/production/ic_list_48px.svg"></md-icon>
					<p>Дисциплины</p>
				</md-list-item>
                <md-list-item ui-sref="map">
					<md-icon md-svg-icon="node_modules/material-design-icons/maps/svg/production/ic_place_48px.svg"></md-icon>
					<p>Как нас найти</p>
				</md-list-item>
				<!-- <md-list-item ui-sref="profile">
					<md-icon md-svg-icon="../node_modules/material-design-icons/action/svg/production/ic_account_circle_48px.svg"></md-icon>
					<p>Профиль</p>
				</md-list-item>
				<md-list-item ui-sref="settings">
					<md-icon md-svg-icon="../node_modules/material-design-icons/action/svg/production/ic_settings_48px.svg"></md-icon>
					<p>Настройки</p>
				</md-list-item> -->
                <md-list-item ng-href="auth.php?do=logout">
                    <md-icon md-svg-icon="node_modules/material-design-icons/action/svg/production/ic_exit_to_app_48px.svg"></md-icon>
                    <p>Выход</p>
                </md-list-item>
			</md-list>
		</md-content>
	</md-sidenav>

	<div layout="column" class="relative" layout-fill role="main" ui-view>
		<!-- here is template content -->
	</div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

<script src="http://angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>

<script src="js/disciplineListCtrl.js"></script>
<script src="js/disciplineFilter.js"></script>
<script src="js/mapCtrl.js"></script>
<script src="js/appCtrl.js"></script>
<script src="js/app.js"></script>

</html>
