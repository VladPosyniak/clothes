authApp.controller('authController', authController);


    function authController($auth) {

        var vm = this;

        vm.login = function() {

            var credentials = {
                email: vm.email,
                password: vm.password
            }

            $auth.login(credentials).then(function(data) {
                console.log("working");
            });
        }

    }