var posts=angular.module('postsApp', ['infinite-scroll']);


var main=angular.module('mainApp',['postsApp','ngRoute']);