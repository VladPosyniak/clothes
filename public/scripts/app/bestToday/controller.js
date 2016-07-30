main.controller('besttodayController',['$scope','getBestPosts', besttodayController]);



 function besttodayController($scope,getBestPosts) {
 	console.log('eee');
 	getBestPosts(0,2).then(function (data) {
		$scope.bests=data;
	});

 }