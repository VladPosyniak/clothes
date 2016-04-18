postsApp.controller('postsController',['$scope','getPosts','postid', posts]);

function posts($scope,getPosts,postid){
	$scope.posts =[];
	$scope.getNextPosts=function (){
		getPosts.then(function (data) {
		    $scope.posts = $scope.posts.concat(data);
		    
		    for(var i=0; i<data.length; i++){
		    	data[i].taglist = data[i].tags.split(',');
		    }
		    console.log(data);
		    });
   }

   $scope.click=function(index){
   		postid.selectid(index);
   }
}