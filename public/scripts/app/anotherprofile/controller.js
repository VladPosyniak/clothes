profileApp.controller('another_profileController',['$scope','$window','getUser','useridbroadcast','getPhotos', another_profileController]);



 function another_profileController($scope,$window,getUser,useridbroadcast,getPhotos) {
 	$scope.photos=[];
 	var pack=1;
	getPhotos(window.sessionStorage['satellizer_token'],useridbroadcast.id,pack).success(function(data){
				for(var i=0; i<5; i++){
					if(data[i]){
						$scope.photos.push.apply($scope.photos,data[i]['images'].split(','));
					}
				}

				pack+=1;
			

	    	});   
 	
	 	 
	$scope.$on('useridbroadcast', function() {
		
	    $scope.userid=useridbroadcast.id;
        if(useridbroadcast.id!=null){
        	getUser(window.sessionStorage['satellizer_token'],useridbroadcast.id).success(function(data){
			
			$scope.data=data;

	    	});   
        }
	 });

	useridbroadcast.selectid(38);


 }