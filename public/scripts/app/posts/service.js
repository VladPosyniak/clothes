posts.factory('getPosts',['$http',function($http){
    return $http.get("public/getPosts")
        .then(function (response) {
            var json=response.data;
            return json;
        });
}
]);