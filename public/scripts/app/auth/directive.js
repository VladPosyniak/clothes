postsApp.directive('auth',function(){
    return {
        resrtict: "E",
        scope: {
        },
        templateUrl: 'scripts/app/auth/template.html',
        controller:'authController'
    }
}
);