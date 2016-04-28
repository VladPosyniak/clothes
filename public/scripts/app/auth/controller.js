authApp.controller('authController',['$scope','$rootScope','$auth','$window','unlink', authController]);


    function authController($scope,$rootScope,$auth,$window,unlink) {
        $auth.setStorageType('sessionStorage');


        if($window.sessionStorage.satellizer_token){
            $rootScope.token=$window.sessionStorage.satellizer_token;
            $scope.token=$window.sessionStorage.satellizer_token;
        }
        console.log($window.sessionStorage.token);

        $scope.login = function() {

            var credentials = {
                email: $scope.email,
                password: $scope.password
            }

            $auth.login(credentials).then(function(data) {
                $rootScope.token=data.data.token;
                $scope.token=data.data.token;
            });
        }

        $scope.authenticate = function(provider) {
            $auth.authenticate(provider).then(function(response) {

            $rootScope.token=response.data.token;
            $scope.token=response.data.token;
            console.log(response);
            });

        }

        $scope.logout = function() {
            $scope.token=null;
            $window.sessionStorage.clear();
        }

        $scope.unlink= function(name) {
            unlink(name, $scope.token).success(function(response){
                console.log(response.status);
            });
        }

    }


    //1053405629906-u1l6ajc3qk4n76umo3q18g2egkv7jfqn.apps.googleusercontent.com