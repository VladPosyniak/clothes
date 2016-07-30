postsApp.controller('modalPostController',['$scope','$window','postid','singlePost','comments','create_comment','delete_comment', modalPost]);

function modalPost($scope,$window,postid,singlePost,comments,create_comment,delete_comment){

    $scope.postid=0;
    var modal = document.getElementById('myModal');

    $scope.comments=[];

    if($window.sessionStorage.satellizer_token){
        $scope.id=$window.sessionStorage.id;
   }else{
        $scope.id=false;
   }

   $scope.$on('auth_updateBroadcast', function() {
        if($window.sessionStorage.satellizer_token){
            $scope.id=$window.sessionStorage.id;
        }else{
             $scope.id=false;
        }
   });

   console.log($scope.id);

    $scope.$on('postidBroadcast', function() {
        $scope.postid=postid.id;
        if(postid.id!=0){
            singlePost(postid.id).success(function(data){
                $scope.post=data;
                if(data.tag){
                    data.taglist = data.tag.split(',');
                    console.log(data.taglist);
                }
            
                var reg = /(,).*/;

                if(reg.test(data.images)){
                    data.imagesArr=data.images.split(',');
                }
                else{
                    data.imagesArr=[data.images];
                }
                
            });


            comments(postid.id).success(function(data){
                for(var i=0;i<data.length;i++){
                    $scope.comments.push(data[i]);
                    console.log(data[i]);
                }
            });
        }

   });

    $scope.close=function(){
        postid.selectid(0);
        $scope.comments=[];
    }

    $scope.create_comment=function(){
        var token=$window.sessionStorage.satellizer_token;
        create_comment($scope.post.id,$scope.content,token).success(function(data){
            console.log('done');
        });
    }


    $scope.delete_comment=function(id){
        var token=$window.sessionStorage.satellizer_token;
        delete_comment(id,token).success(function(data){
            console.log('done');
        });
    }



}