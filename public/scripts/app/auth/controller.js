authApp.controller('authController',['$scope','$auth','$window','unlink','auth_update', authController]);


    function authController($scope,$auth,$window,unlink,auth_update) {
        $auth.setStorageType('sessionStorage');
        $scope.visible=false;


        if($window.sessionStorage.satellizer_token){
            $rootScope.token=$window.sessionStorage.satellizer_token;
            $scope.token=$window.sessionStorage.satellizer_token;
        }
        console.log($window.sessionStorage.token);

        $scope.login = function() {

            var credentials = {
                email: $scope.email,
                password: $scope.password
            }

            $auth.login(credentials).then(function(data) {
                data=data.data;
                
                $scope.token=data.token;
                $window.sessionStorage.id=data.id;
                auth_update.selectid(data.token,data.id);
                auth_update.broadcast();
            });
        }

        $scope.authenticate = function(provider) {
            $auth.authenticate(provider).then(function(response) {
            console.log(response);

            $scope.token=response.data.token;
            $window.sessionStorage.id=response.data.id;
            auth_update.selectid(response.data.token,response.data.id);
            auth_update.broadcast();
            });

        }

        $scope.authVis=function(){
            $scope.visible=true;
        }

        $scope.close=function(){
            $scope.visible=false;
        }
    }


    //1053405629906-u1l6ajc3qk4n76umo3q18g2egkv7jfqn.apps.googleusercontent.com