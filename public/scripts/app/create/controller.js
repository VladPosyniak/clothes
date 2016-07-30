postsApp.controller('createController',['$scope','create','Upload','$window','$timeout',createController]);


    function createController($scope,create,Upload,$window, $timeout) {
        $scope.tags='';
        var tags=[];

        $scope.add_tag=function(){
            if( $scope.tags===''){
                $scope.tags+="Теги: "+$scope.tag;
            }else{
                $scope.tags+=','+$scope.tag;
            }
            tags.push($scope.tag);
            $scope.tag='';
            console.log(tags);
        }


         
        $scope.submit=function(){
            if($window.sessionStorage.satellizer_token){
                var token=$window.sessionStorage.satellizer_token;
            }

            $scope.upload($scope.file,$scope.title,$scope.content,token);

        }


        $scope.upload = function (file,title,content,token) {
            var random_id=Math.floor(Math.random()*(2000-100+1));

            if (file && file.length) {
                var status=file.length-1;
                var fail=file.length+5;
                tags=JSON.stringify(tags);
                console.log(tags);
           
                //for (var i = 0; i < file.length; i++) {
                    run(status,fail);
                     function run(){ $timeout(function() {
                       
                       Upload.upload({
                        url: 'api/createPost',
                        method: 'POST',
                        file: file[status],
                        sendFieldsAs: 'form',
                        fields: {
                            title:title,content:content,tags:tags,token:token,random_id:random_id
                        }}).then( function (response) {

                            console.log(response.data);
                            console.log(status);
                             if(response.data.result){
                                status-=1;
                             }
                             if(fail==0){
                                console.log('fail');
                             }else{
                                if(status==-1){
                                $scope.content='';
                                $scope.title='';
                                $scope.file=null;
                                $scope.tags='';
                             }else{
                                console.log(fail);
                                fail-=1;
                                run(status,fail);
                             }
                             }
                             
                        });
                    }, 500)
            }
            //}
            
        }
}





    }



    //1053405629906-u1l6ajc3qk4n76umo3q18g2egkv7jfqn.apps.googleusercontent.com