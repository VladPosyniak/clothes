main.controller('leftController',['$scope','$rootScope','$window','auth_update', leftController]);


    function leftController($scope,$rootScope,$window,auth_update) {
        if($window.sessionStorage.satellizer_token){
            $rootScope.token=$window.sessionStorage.satellizer_token;
            $scope.token=$window.sessionStorage.satellizer_token;
        }

        $scope.$on('auth_updateBroadcast', function() {
            $scope.token=$window.sessionStorage.satellizer_token;
        });


        $scope.unlink= function(name) {
            unlink(name, $scope.token).success(function(response){
                console.log(response.status);
            });
        }

    }

