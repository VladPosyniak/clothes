main.controller('postsController',['$scope','getPosts', posts]);

function posts($scope,getPosts){
	$scope.posts =[];
	$scope.getNextPosts=function (){
		getPosts.then(function (data) {
		    $scope.posts = $scope.posts.concat(data);
		    console.log(data);
		    });
   }
}