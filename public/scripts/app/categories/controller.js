main.controller('categoriesController',['$scope','search','typeOfPosts','getTags', categoriesController]);


    function categoriesController($scope,search,typeOfPosts,getTags) {

    	getTags().then(function(json){
			$scope.tags=json;
		}); 
    	$scope.tag_select=function(tag){
    		search.selectsearch(tag);
    		typeOfPosts.selectType('search');
    	}
    }

