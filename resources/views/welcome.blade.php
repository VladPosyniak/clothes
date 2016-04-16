<!doctype html>
<html lang="ru">
<head>
    <title></title>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href="{{asset('css/style.css')}}"/>


<script src="{{asset('scripts/app/lib/jquery-2.2.1.min.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular-route.js')}}"></script>
    <script src="{{asset('scripts/app/lib/angular-1.5.0-rc.0/angular-mocks.js')}}"></script>
    <script src="{{asset('scripts/app/lib/ng-infinite-scroll.min.js')}}"></script>
    <script src="{{asset('scripts/app/lib/satellizer.min.js')}}"></script>
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

</head>
<body ng-app="mainApp">
<div id="wrapper">
<div id="line"><br></div>
    <div id="main">
        <div class="lside">
            </br>
            </br>
            <div class="linside">
                surprise, motherfucker!
                гостю-тут будет просто инфа о сайте и так далее

                вошедшему-будет инфа о пользователе
                <auth></auth>
            </div>

        </div>
        <div class="posts" >

            <modalpost></modalpost>
            <posts></posts>
        </div>

    </div>
</div>

<footer>
    <ul>
        <li><a href="#">EzCoders</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About us</a></li>
    </ul>
</footer>
</body>
</html>
