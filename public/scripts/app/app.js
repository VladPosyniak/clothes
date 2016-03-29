var postsApp=angular.module('postsApp', ['infinite-scroll']);
var authApp=angular.module('authApp', ['satellizer']);

var main=angular.module('mainApp',['authApp','postsApp','ngRoute']);
