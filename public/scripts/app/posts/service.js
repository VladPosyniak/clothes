postsApp.factory('getPosts',['$http',function($http){
    return function(pack,token){
	    return $http.post("api/getPostsSub",{pack:pack,token:token})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
		}
	}
]);


postsApp.factory('postid',function($rootScope){
	var postid={};

	postid.id=0;

	postid.selectid=function(id){
		this.id=id;
		this.broadcast();
	}

	postid.broadcast = function() {
        $rootScope.$broadcast('postidBroadcast');

    };

	return postid;

   
}
);


postsApp.factory('typeOfPosts',function($rootScope){
	var typeOfPosts={};

	typeOfPosts.type=null;

	typeOfPosts.selectType=function(type){
		this.type=type;
		this.broadcast();
	}

	typeOfPosts.broadcast = function() {
        $rootScope.$broadcast('typeOfPostsBroadcast');

    };

	return typeOfPosts;

   
}
);



postsApp.factory('search',function($rootScope){
	var search={};

	search.search='';

	search.selectsearch=function(search){
	
		this.search=search;
		this.broadcast();
		
		
	}

	search.broadcast = function() {
        $rootScope.$broadcast('searchBroadcast');

    };

	return search;

   
}
);



postsApp.factory('getBestPosts',['$http',function($http){
    return function(pack,interval){
	    return $http.post("api/getPostsBest",{pack:pack,interval:interval})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
		}
	}
]);


postsApp.factory('getSearchedPosts',['$http',function($http){
    return function(pack,search){
	    return $http.post("api/search",{pack:pack,search:search})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
		}
	}
]);


postsApp.factory('like',['$http',function($http){
	return function (id,token) {
	    return $http.post("api/like",{idpost:id,token:token})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);

postsApp.factory('dislike',['$http',function($http){
	return function (id,token) {
	    return $http.post("api/dislike",{idpost:id,token:token})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);


