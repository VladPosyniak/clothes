profileApp.controller('profileController',['$scope','$window','leftToken', profileController]);



 function profileController($scope,$window,leftToken) {
	 $scope.logout = function() {
	            $scope.token=null;
	            $window.sessionStorage.clear();

	            leftToken.broadcast();
	        }

    }