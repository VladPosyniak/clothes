main.controller('searchController',['$scope','search','typeOfPosts','$location', searchController]);

function searchController($scope,search,typeOfPosts,$location){

	 $scope.$on('searchBroadcast', function() {
	 	if(search.search!=$scope.field){
	 		$scope.field=search.search;
	 	}
   });

	$scope.search= function(){
		if($scope.field!=undefined){

			search.selectsearch($scope.field);
			typeOfPosts.selectType('search');
		}
	}
	$scope.url=$location.path();
	if($scope.url.split('/')[1]=='search'){
		$scope.field=$scope.url.split('/')[2];
		typeOfPosts.selectType('search');
		search.selectsearch($scope.url.split('/')[2]);
	}

}
	 