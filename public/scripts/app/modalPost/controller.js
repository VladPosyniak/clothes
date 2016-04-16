postsApp.controller('modalPostController',['$scope','postid', modalPost]);

function modalPost($scope,postid){

	$scope.postid=0;

	$scope.$on('postidBroadcast', function() {
                console.log(postid.id);
            });

	$scope.$on('postidBroadcast', function() {
        $scope.postid=postid.id;
   });

	$scope.close=function(){
		postid.selectid(0);
	}


}