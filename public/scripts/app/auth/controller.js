authApp.controller('authController', authController);


    function authController($scope,$rootScope,$auth,$window) {
        if($window.sessionStorage.token){
            $rootScope.token=$window.sessionStorage.token;
            $scope.token=$window.sessionStorage.token;
        }
        console.log($window.sessionStorage.token);

        $scope.login = function() {

            var credentials = {
                email: $scope.email,
                password: $scope.password
            }

            $auth.login(credentials).then(function(data) {
                $window.sessionStorage.token=data.data.token;
                $rootScope.token=data.data.token;
                $scope.token=data.data.token;
            });
        }

        $scope.logout = function() {
            $scope.token=null;
            $window.sessionStorage.clear();
        }

    }