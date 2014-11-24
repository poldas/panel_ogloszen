define(['jquery', 'underscore', 'backbone', 'modules/TaskItem'], 
function($, _, Backbone, TaskModel){
    var TaskCollection = Backbone.Collection.extend({
        url: '/task/getajaxlist',
        initialize: function(options) {
            this.model = options.model;
            this.fetch();
        }
    });
    
  return TaskCollection;
});