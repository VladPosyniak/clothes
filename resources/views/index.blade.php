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
    <script src="{{asset('scripts/app/app.js')}}"></script>
    <script src="{{asset('scripts/app/posts/service.js')}}"></script>
    <script src="{{asset('scripts/app/posts/controller.js')}}"></script>

</head>
<body ng-app="mainApp">
<div id="wrapper">
	<div id="main">

		<div class="news" ng-controller="postsController" >
			<div infinite-scroll="getNextPosts()" infinite-scroll-distance="0">
				<div  ng-repeat="post in posts track by $index">
				<h2>@{{post.title}}</h2>
				<img ng-src="@{{post.images}}"/>
				</div>
			</div>	
		</div>

	</div>
</div>
</body>
</html>
