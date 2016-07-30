postsApp.directive('createpost',function(){
    return {
        resrtict: "E",
        scope: {
        },
        templateUrl: 'scripts/app/create/template.html',
        controller:'createController'
    }
}
);