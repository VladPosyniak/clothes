postsApp.directive('modalpost',['postid',function(postid){
    return {
        resrtict: "E",
        scope: {
        	postid:"@postid"
        },
        templateUrl: 'scripts/app/modalPost/template.html',
        controller:'modalPostController'
    }
}
]);