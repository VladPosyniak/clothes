postsApp.controller('postsController',['$rootScope','$scope','getPosts','postid','getUserById','like','dislike','$window','$attrs','getBestPosts', posts]);

function posts($rootScope,$scope,getPosts,postid,getUserById,like,dislike,$window,$attrs,getBestPosts){
	 

	$scope.posts =[];
	$scope.interval=0;
	var pack=0;
	var fail=false;
	var summ=0;
	var res=[];
	$scope.getNextPosts=function (){

		switch($attrs.poststype){
			case 'sub':
				sub();
				$scope.type='sub';
				break;
			case 'best':
				best();
				$scope.type='best';
				break;
			
		}

   }

   $scope.click=function(index){
   		postid.selectid(index);
   }

	$scope.like=function(id){
		if($window.sessionStorage.satellizer_token){
            var token=$window.sessionStorage.satellizer_token;
     
	   		like(id,token).then(function(json){
					   console.log(json);
			}); 
   		}
   }

   $scope.dislike=function(id){
		if($window.sessionStorage.satellizer_token){
            var token=$window.sessionStorage.satellizer_token;
     
	   		dislike(id,token).then(function(json){
					   console.log(json);
			}); 
   		}
   }

   $scope.bestof=function(interval){
   		$scope.interval=interval;
   		$scope.posts =[];
   		pack=0;
   		best();
   }






   function sub(){

	if($window.sessionStorage.satellizer_token){
			if(!fail){
	            var token=$window.sessionStorage.satellizer_token;

				getPosts(pack,token).then(function (data) {
					
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

				    summ+=data.length;
				    $scope.posts = $scope.posts.concat(data);
				    
				    if(summ===res){
				    	fail=true;
				    }else{
				    	res=$scope.posts.length;
				    }
				});
				pack+=1;

			}
		

		}
		else{
			$scope.posts = $scope.posts.concat({title:'error, please log in'});
		}

	}

	function best(){

		if(!fail){
				getBestPosts(pack,$scope.interval).then(function (data) {
					
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

				    summ+=data.length;
				    $scope.posts = $scope.posts.concat(data);
				    
				    if(summ===res){
				    	fail=true;
				    }else{
				    	res=$scope.posts.length;
				    }
				});
				pack+=1;

			}

	}
}




