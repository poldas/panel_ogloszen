define(['jquery', 'underscore', 'backbone', 'modules/TaskItem'], 
function($, _, Backbone, TaskModel){
    var TaskCollection = Backbone.Collection.extend({
        el: '#backbone-content',
        url: '/task/getajaxlist',
        model: TaskModel,
        initialize: function() {
            this.fetch();
        }
    });
    
  return TaskCollection;
});