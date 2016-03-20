postsApp.controller('modalPostController',['$scope','postid','singlePost', modalPost]);

function modalPost($scope,postid,singlePost){

	$scope.postid=0;

	$scope.$on('postidBroadcast', function() {
        $scope.postid=postid.id;
        if(postid.id!=0){
        	singlePost(postid.id).success(function(data){
        		$scope.post=data;
        	});
        }

   });

	$scope.close=function(){
		postid.selectid(0);
	}




}