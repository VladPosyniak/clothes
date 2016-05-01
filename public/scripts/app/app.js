var postsApp=angular.module('postsApp', ['infinite-scroll']);
var authApp=angular.module('authApp', ['satellizer']);

var profileApp=angular.module('profileApp',['authApp']);


var main=angular.module('mainApp',['postsApp','profileApp','ngRoute','ngAnimate']);
