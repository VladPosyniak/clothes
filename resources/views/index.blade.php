<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>home</title>
    <link rel="stylesheet" href="{{asset('css/IndexStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/subStyle.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">


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
<<<<<<< HEAD
<<<<<<< HEAD
    <script src="{{asset('scripts/app/modalPost/service.js')}}"></script>
    <script src="{{asset('scripts/app/auth/controller.js')}}"></script>
    <script src="{{asset('scripts/app/auth/directive.js')}}"></script>
<<<<<<< HEAD
    <script src="{{asset('scripts/app/switcher/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/comments/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/messages/directive.js')}}"></script>
    <script src="{{asset('scripts/app/sub/subscriptions/directive.js')}}"></script>


=======
=======
>>>>>>> parent of bee7e80... modal post full
=======
>>>>>>> parent of bee7e80... modal post full
>>>>>>> origin/master

</head>
<body ng-app="mainApp">
<div class="wrapper">

<div id="auth">




</div>
    <div class="left-panel">
        <div class="search-module">
            <input type="text" placeholder="search">
        </div>

        <div class="menu-module">
            <span>
                <img src="https://pp.vk.me/c624117/v624117735/428dd/9g5-B8iHzpM.jpg" alt="">
                <h2>Vlad Posyniak</h2>
            </span>

            <switcher></switcher>
            
        </div>

        <div class="friends-module">
            <h2><a href="#">Friends:</a></h2>
            <ul>
                <li><img src="https://pp.vk.me/c630329/v630329369/278e3/F1UZSDku2SU.jpg" alt=""><a href="#">Anton
                    Rytov</a></li>
                <li><img src="https://pp.vk.me/c630329/v630329369/278e3/F1UZSDku2SU.jpg" alt=""><a href="#">Anton
                    Rytov</a></li>
                <li><img src="https://pp.vk.me/c630329/v630329369/278e3/F1UZSDku2SU.jpg" alt=""><a href="#">Anton
                    Rytov</a></li>
                <li><img src="https://pp.vk.me/c630329/v630329369/278e3/F1UZSDku2SU.jpg" alt=""><a href="#">Anton
                    Rytov</a></li>
                <li><img src="https://pp.vk.me/c630329/v630329369/278e3/F1UZSDku2SU.jpg" alt=""><a href="#">Anton
                    Rytov</a></li>
            </ul>
        </div>

        <div class="exit-button">
            <button>logout</button>
        </div>
    </div>

    <div class="container">
    <div id="main_activity">
        <div class="posts">
            <div class="create-post">
                <input type="text" name="nameOfPost" required placeholder="название">
                <textarea name="" id="">описание</textarea>
                <button class="Add">добавить фотографию</button>
                <button class="Add">выбрать категории</button>
                <button class="sendPost">опубликовать</button>
            </div>

            <modalpost></modalpost>
            <posts></posts>

        </div>
    </div>
    
    <div class="posts">
        <div id="sub_activity">
    </div>
    



    </div>    

        <div class="right-panel">

        <div class="popular-module">
               <auth></auth>
            </div>

            <div class="popular-module">
                <h3>Popular today:</h3>
                <ul>
                    <li><a href="">clothes for best days</a><span class="popular-module-likes">213+</span></li>
                    <li><a href="">clothes for best days</a><span class="popular-module-likes">203+</span></li>
                    <li><a href="">clothes for best days</a><span class="popular-module-likes">113+</span></li>
                    <li><a href="">clothes for best days</a><span class="popular-module-likes">35+</span></li>
                </ul>
            </div>


            <div class="categories-module">
                <h3>Categories:</h3>

                <div class="categories">
                    <a href="">кофты</a>
                    <a href="">футболки</a>
                    <a href="">куртки</a>
                    <a href="">джинсы</a>
                    <a href="">рубашки</a>
                    <a href="">шорты</a>
                    <a href="">шорты</a>
                    <a href="">классика</a>
                    <a href="">яркое</a>
                    <a href="">лето</a>
                    <a href="">зима</a>
                    <a href="">аксесуары</a>
                    <a href="">необычное</a>
                    <a href="">брюки</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-min.js"></script>
    <script src="js/scripts.js"></script>
</div>
</body>
</html>