postsApp.controller('postsController',['$rootScope','$scope','getPosts','postid','getUserById', posts]);

function posts($rootScope,$scope,getPosts,postid,getUserById){
	$scope.posts =[];
	$scope.getNextPosts=function (){
		getPosts.then(function (data) {
				$scope.res_name=[];
		    for(var i=0; i<data.length; i++){
		    	data[i].taglist = data[i].tag.split(',');

		    	var reg = /(,).*/;
		    	if(reg.test(data[i].images)){
		    		//data[i].images=data[i].images.split(',');
		    		data[i].imagesArr=data[i].images.split(',');
		    	}
		    	else{
		    		data[i].imagesArr=[data[i].images];
		    	}
		    	

		    	(function(i) {
			    	getUserById(data[i].author,i).then(function(json){
				    	data[i].nameOfAuthor=json.name;
			    	});  

			    })(i);
	
		    }
		    $scope.posts = $scope.posts.concat(data);
		});
   }

   $scope.click=function(index){
   		postid.selectid(index);
   }

}