<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AngularJS Register Login Script using PHP Mysql</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.6/angular.min.js" integrity="sha512-rTAljISl+fitBnL2/6HhbiENEHd87W0DnTh1J7CcRD/dTLTycfceHs1uQEsR83nD86ON4k9N8H8S5OwGzoA9jQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
  .form_style
  {
   width: 600px;
   margin: 0 auto;
  }
  </style>
</head>
<body>
    <br />
        <h3 align="center">AngularJS Register Login Script using PHP Mysql</h3>
    <br />

    <div ng-app="login_register_app" ng-controller="login_register_controller" class="container form_style">
        <?php
            if(!isset($_SESSION["name"]))
            {
        ?>
    <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
        <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
        {{alertMessage}}
    </div>

    <div class="panel panel-default" ng-show="login_form">
        <div class="panel-heading">
            <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
                <form method="post" ng-submit="submitLogin()">
                <div class="form-group">
                    <label>Enter Your Email</label>
                    <input type="text" name="email" ng-model="loginData.email" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Enter Your Password</label>
                    <input type="password" name="password" ng-model="loginData.password" class="form-control" />
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="login" class="btn btn-primary" value="Login" />
                    <br />
                    <input type="button" name="register_link" class="btn btn-link" ng-click="showRegister()" value="Register" />
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default" ng-show="register_form">
        <div class="panel-heading">
            <h3 class="panel-title">Register</h3>
        </div>
        <div class="panel-body">
            <form method="post" ng-submit="submitRegister()">
            <div class="form-group">
                <label>Enter Your Name</label>
                <input type="text" name="name" ng-model="registerData.name" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter Your Email</label>
                <input type="text" name="email" ng-model="registerData.email" class="form-control" />
            </div>
            <div class="form-group">
                <label>Enter Your Password</label>
                <input type="password" name="password" ng-model="registerData.password" class="form-control" />
            </div>
            <div class="form-group" align="center">
                <input type="submit" name="register" class="btn btn-primary" value="Register" />
                <br />
                <input type="button" name="login_link" class="btn btn-link" ng-click="showLogin()" value="Login" />
            </div>
        </form>
        </div>
    </div>
    <?php
    }
    else
    {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Welcome to system</h3>
        </div>
        <div class="panel-body">
            <h1>Welcome - <?php echo $_SESSION["name"];?></h1>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <?php
    }
    ?>

  </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        var app = angular.module('login_register_app', []);
        app.controller('login_register_controller', function($scope, $http){
            $scope.closeMsg = function(){
            $scope.alertMsg = false;
        };

        $scope.login_form = true;

        $scope.showRegister = function(){
            $scope.login_form = false;
            $scope.register_form = true;
            $scope.alertMsg = false;
        };

        $scope.showLogin = function(){
            $scope.register_form = false;
            $scope.login_form = true;
            $scope.alertMsg = false;
        };

        $scope.submitRegister = function(){
            $http({
                method:"POST",
                url:"register.php",
                data:$scope.registerData
            }).success(function(data){
                $scope.alertMsg = true;
                if(data.error != ''){
                    $scope.alertClass = 'alert-danger';
                    $scope.alertMessage = data.error;
                }else{
                    $scope.alertClass = 'alert-success';
                    $scope.alertMessage = data.message;
                    $scope.registerData = {};
                }
            });
        };

        $scope.submitLogin = function(){
            $http({
                method:"POST",
                url:"login.php",
                data:$scope.loginData
            }).success(function(data){
                if(data.error != ''){
                    $scope.alertMsg = true;
                    $scope.alertClass = 'alert-danger';
                    $scope.alertMessage = data.error;
                }else{
                    location.reload();
                }
            });
        };

    });
    </script>
</body>
</html>