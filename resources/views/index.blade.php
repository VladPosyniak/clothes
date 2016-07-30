<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>home</title>
    <base href="/">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="{{asset('css/indexStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.6.3/css/font-awesome.min.css')}}">

    <script src="{{asset('scripts/app/lib/jquery-2.2.1.min.js')}}"></script>
  
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular-route.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular-mocks.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular-animate.js')}}"></script>

    <script src="{{asset('scripts/app/lib/ng-infinite-scroll.min.js')}}"></script>
    <script src="{{asset('scripts/app/lib/satellizer.min.js')}}"></script>
    <script src="{{asset('scripts/app/lib/ng-file-upload.min.js')}}"></script>
    <script src="{{asset('scripts/app/lib/ng-file-upload-shim.min.js')}}"></script>
    


    <script src="{{asset('scripts/app/app.js')}}"></script>
    <script src="{{asset('scripts/app/config.js')}}"></script>
    <script src="{{asset('scripts/app/posts/service.js')}}"></script>
    <script src="{{asset('scripts/app/posts/controller.js')}}"></script>
    <script src="{{asset('scripts/app/posts/directive.js')}}"></script>
    <script src="{{asset('scripts/app/modalPost/controller.js')}}"></script>
    <script src="{{asset('scripts/app/modalPost/directive.js')}}"></script>
    <script src="{{asset('scripts/app/modalPost/service.js')}}"></script>
    <script src="{{asset('scripts/app/auth/controller.js')}}"></script>
    <script src="{{asset('scripts/app/auth/directive.js')}}"></script>
    <script src="{{asset('scripts/app/auth/config.js')}}"></script>
    <script src="{{asset('scripts/app/switcher/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/comments/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/best/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/subscriptions/directive.js')}}"></script>
    <script src="{{asset('scripts/app/auth/service.js')}}"></script>
    <script src="{{asset('scripts/app/profile/directive.js')}}"></script>
    <script src="{{asset('scripts/app/profile/controller.js')}}"></script>
    <script src="{{asset('scripts/app/anotherprofile/directive.js')}}"></script>
    <script src="{{asset('scripts/app/anotherprofile/service.js')}}"></script>
    <script src="{{asset('scripts/app/anotherprofile/controller.js')}}"></script>
    <script src="{{asset('scripts/app/left/directive.js')}}"></script>
    <script src="{{asset('scripts/app/left/controller.js')}}"></script>
    <script src="{{asset('scripts/app/left/service.js')}}"></script>
    <script src="{{asset('scripts/app/profile/service.js')}}"></script>
    <script src="{{asset('scripts/app/create/service.js')}}"></script>
    <script src="{{asset('scripts/app/create/directive.js')}}"></script>
    <script src="{{asset('scripts/app/create/controller.js')}}"></script>
    <script src="{{asset('scripts/app/search/directive.js')}}"></script>
    <script src="{{asset('scripts/app/search/controller.js')}}"></script>
    <script src="{{asset('scripts/app/categories/directive.js')}}"></script>
    <script src="{{asset('scripts/app/categories/controller.js')}}"></script>
    <script src="{{asset('scripts/app/categories/service.js')}}"></script>
    <script src="{{asset('scripts/app/winner/service.js')}}"></script>
    <script src="{{asset('scripts/app/winner/directive.js')}}"></script>
    <script src="{{asset('scripts/app/winner/controller.js')}}"></script>
    <script src="{{asset('scripts/app/bestToday/directive.js')}}"></script>
    <script src="{{asset('scripts/app/bestToday/controller.js')}}"></script>

</head>
<body ng-app="mainApp">


    

<div class="mobile-menu">

</div>

<div class="wrapper">
    <div class="mobile-menu-button">
        <img src="images/mobile_menu.png" alt="">
    </div>

    <div class="left-panel">
        <search></search>
        <left></left>
    </div>

    <div class="container">
        <div class="central-content">
            <createPost></createPost>

            <div class="posts">
                <!--<anotherprofile></anotherprofile>-->
                
                <modalpost></modalpost>
                <posts poststype='sub'></posts>
            </div>

            </div>

            <div class="right-panel">
                <besttoday></besttoday>

                <winner></winner>

                <categories></categories>
            </div>


        </div>
</div>
</body>
</html>