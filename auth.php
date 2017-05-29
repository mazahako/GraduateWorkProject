<!DOCTYPE html>
<html lang="en" ng-app="AuthApp">

<head>
    <meta charset="UTF-8">
    <title>K504</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
</head>

<body layout="row" flex layout-fill layout-align="center center">
<md-content flex="70" flex-gt-xs="40" flex-gt-sm="25" flex-gt-md="20">
    <md-card md-whiteframe="8">
        <img ng-src="img/k504.jpg" class="md-card-image">
        <md-card-title>
            <md-card-title-text layout-align="center center">
                <span class="md-headline">Авторизируйтесь</span>
                <span class="md-subhead">c помощью..</span>
            </md-card-title-text>
        </md-card-title>
        <md-divider></md-divider>
        <md-card-actions layout="column" layout-align="start">
            <md-button target="_self" ng-href="http://oauth.vk.com/authorize?client_id=5883776&redirect_uri=http://localhost/GraduateWork/API/vk.php&response_type=code" class="md-primary">ВКонтакте</md-button>
            <md-button target="_self" ng-href="http://www.odnoklassniki.ru/oauth/authorize?client_id=1249921792&response_type=code&redirect_uri=http://localhost/GraduateWork/API/ok.php" class="md-primary">Однокласники</md-button>
            <md-button target="_self" ng-href="https://www.facebook.com/dialog/oauth?client_id=176216536202399&redirect_uri=http://localhost/GraduateWork/API/facebook.php&response_type=code&scope=email,user_birthday" class="md-primary">Facebook</md-button>
            <md-button target="_self" ng-href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://localhost/GraduateWork/API/google.php&response_type=code&client_id=826057968516-cikh39okvmei2hojokpaciv2lcm16oop.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile" class="md-primary">Google</md-button>
        </md-card-actions>
    </md-card>
</md-content>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>

<script src="node_modules/particles.js/particles.js"></script>
<script src="js/authApp.js"></script>

</html>
