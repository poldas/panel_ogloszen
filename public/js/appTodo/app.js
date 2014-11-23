define([
  'jquery',
  'underscore',
  'backbone',
  'routes/Router',
  'views/AppView',
  'collections/TaskCollection'
], function($, _, Backbone, Router, AppView, TaskCollection){
    
  var initialize = function() {
//    var TaskList = new TaskCollection();
//    var appView = new AppView();
    var router = new Router();
    Backbone.history.start();
  };
  
  return {
      initialize: initialize
  };
});