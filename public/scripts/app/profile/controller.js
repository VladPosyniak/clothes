profileApp.controller('profileController',['$scope','$window','leftToken','getSelf','getUserById', profileController]);



 function profileController($scope,$window,leftToken,getSelf,getUserById) {
	 $scope.logout = function() {
	            $window.sessionStorage.clear();

	            leftToken.broadcast();
	        }

	getSelf(window.sessionStorage['satellizer_token']).success(function(data){
		$scope.name=data.name;
		$scope.rating=data.rating;
		$scope.avatar=data.avatar;
		$scope.new_m=data.new_messages;
		$scope.new_c=data.new_comments;
		$scope.friendsIds=data.friends.split(',');

		$scope.friends=[];

		for(i=0;i<$scope.friendsIds.length;i++){
			getUserById($scope.friendsIds[i]).then(function(data){
		    	$scope.friends=$scope.friends.concat(data);
		
		    });  
		}

        	});        

    }