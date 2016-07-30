postsApp.controller('postsController',['$rootScope','$scope','getPosts','postid','like','dislike','$window','$attrs','getBestPosts','search','getSearchedPosts','auth_update','typeOfPosts', posts]);

function posts($rootScope,$scope,getPosts,postid,like,dislike,$window,$attrs,getBestPosts,search,getSearchedPosts,auth_update,typeOfPosts){
	 

	$scope.posts =[];
	$scope.interval=0;
	var pack=0;
	var fail=false;
	var summ=0;
	var res=[];
	$scope.users=[];
	$scope.search=search.search;
	$scope.getNextPosts=function (){

			switch(typeOfPosts.type){
				case 'subscriptions':
					sub();
					$scope.type='sub';
					break;
				case 'best':
					best();
					$scope.type='best';
					break;
				case 'activity':
					sub();
					$scope.type='sub';
					break;
				case 'search':
					searchInit();
					$scope.type='search';
					break;
			}
   }

   if($window.sessionStorage.satellizer_token){
   		$scope.auth=true;
   }else{
   		$scope.auth=false;
   }

   $scope.$on('auth_updateBroadcast', function() {
        if($window.sessionStorage.satellizer_token){
   			$scope.auth=true;
   		}else{
   			$scope.auth=false;
   		}
   });

   $scope.click=function(index){
   		postid.selectid(index);
   }

	$scope.like=function(id,index){
		if($window.sessionStorage.satellizer_token){
            var token=$window.sessionStorage.satellizer_token;
     
	   		like(id,token).then(function(json){
					  if(json.like==='done'){
					  	$scope.posts[index].rating+=1;
					  }
			}); 
   		}
   		
   }

   $scope.dislike=function(id,index){
		if($window.sessionStorage.satellizer_token){
            var token=$window.sessionStorage.satellizer_token;
     
	   		dislike(id,token).then(function(json){
					   if(json.dislike==='done'){
					  	$scope.posts[index].rating-=1;
					  }
			}); 
   		}
   }

   $scope.categoty_find=function(tag){
   		search.selectsearch(tag);
    	typeOfPosts.selectType('search');

   }

   $scope.bestofinterval=function(interval){
   		if($scope.interval!=interval){
   			$scope.posts =[];
	   		$scope.interval=interval;
	   		fail=false;
	   		pack=0;
	   	}
   }



   $scope.$on('typeOfPostsBroadcast', function() {
	 	fail=false;
	    $scope.posts =[];
	   	pack=0;
	   	summ=0;
	   	$scope.getNextPosts();

   });

   function sub(){

	if($window.sessionStorage.satellizer_token){
			if(!fail){

	            var token=$window.sessionStorage.satellizer_token;

				getPosts(pack,token).then(function (data) {
					
				    for(var i=0; i<data.length; i++){
				    	data[i].taglist = data[i].tag.split(',');

				    	var reg = /(,).*/;
				    	if(reg.test(data[i].images)){
				    		data[i].imagesArr=data[i].images.split(',');
				    	}
				    	else{
				    		data[i].imagesArr=[data[i].images];
				    	}
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
				    		data[i].imagesArr=data[i].images.split(',');
				    	}
				    	else{
				    		data[i].imagesArr=[data[i].images];
				    	}
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

	function searchInit(){
		$scope.search=search.search;

			if(!fail){
				getSearchedPosts(pack,search.search).then(function (data) {
					
					if(data.search){
				    		fail=true;
				    	}else{

					    for(var i=0; i<data.length; i++){
					    	data[i].taglist = data[i].tag.split(',');

					    	var reg = /(,).*/;
					    	if(reg.test(data[i].images)){
					    		data[i].imagesArr=data[i].images.split(',');
					    	}
					    	else{
					    		data[i].imagesArr=[data[i].images];
					    	}
					    }

					    summ+=data.length;
					    $scope.posts = $scope.posts.concat(data);
					    
					    if(summ===res){
					    	fail=true;
					    }else{
					    	res=$scope.posts.length;
					    }
					   }
					});
					pack+=1;

			}

	}
}




