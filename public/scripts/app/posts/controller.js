postsApp.controller('postsController',['$scope','getPosts','postid','getUserById', posts]);

function posts($scope,getPosts,postid,getUserById){
	$scope.posts =[];
	$scope.getNextPosts=function (){
		getPosts.then(function (data) {

		    for(var i=0; i<data.length; i++){
		    	data[i].taglist = data[i].tag.split(',');
		    	getUserById(data[i].author).then(function(data){
		    	$scope.res_name=data.name;});  
		    	data[i].nameOfAuthor= $scope.res_name;
		    }
		    $scope.posts = $scope.posts.concat(data);
		    });
   }

   $scope.click=function(index){
   		postid.selectid(index);
   }
}