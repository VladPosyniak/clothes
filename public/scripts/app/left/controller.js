main.controller('leftController',['$scope','$rootScope','$window','leftToken', leftController]);


    function leftController($scope,$rootScope,$window,leftToken) {
        if($window.sessionStorage.satellizer_token){
            $rootScope.token=$window.sessionStorage.satellizer_token;
            $scope.token=$window.sessionStorage.satellizer_token;
        }

        $scope.$on('leftTokenBroadcast', function() {
             $rootScope.token=$window.sessionStorage.satellizer_token;
            $scope.token=$window.sessionStorage.satellizer_token;

        });


        $scope.unlink= function(name) {
            unlink(name, $scope.token).success(function(response){
                console.log(response.status);
            });
        }

    }

