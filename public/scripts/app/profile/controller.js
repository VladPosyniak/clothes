profileApp.controller('profileController',['$scope','$window','auth_update','getSelf','getUserById', profileController]);



 function profileController($scope,$window,auth_update,getSelf,getUserById) {
	 $scope.logout = function() {
	            $window.sessionStorage.clear();

	            auth_update.broadcast();
	        }

	getSelf(window.sessionStorage['satellizer_token']).success(function(data){
		$scope.name=data.name;
		$scope.rating=data.rating;
		$scope.avatar=data.avatar;
		$scope.new_c=data.new_comments;
/*
		if(data.friends){

		
			$scope.friendsIds=data.friends.split(',');

			$scope.friends=[];

			for(i=0;i<$scope.friendsIds.length;i++){
				getUserById($scope.friendsIds[i]).then(function(data){
			    	$scope.friends=$scope.friends.concat(data);
			
			    });  
			}

		}
*/

    });       



 }