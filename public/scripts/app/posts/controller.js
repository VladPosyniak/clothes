postsApp.controller('postsController',['$scope','getPosts','postid', posts]);

function posts($scope,getPosts,postid){
	$scope.posts =[];
	$scope.getNextPosts=function (){
		getPosts.then(function (data) {
		    $scope.posts = $scope.posts.concat(data);
		    console.log(data);
		    });
   }

   $scope.click=function(index){
   		postid.selectid(index);
   }
}