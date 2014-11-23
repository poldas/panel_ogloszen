define(['jquery', 'underscore', 'backbone', 'views/TaskView'], function($, _, Backbone, TaskView){
    'use strict';
    var TaskListView = Backbone.View.extend({
        el: $('#backbone-content'),
        initialize: function() {
          this.model.on('add', this.renderItem, this);
          this.render();
        },
        render: function() {
            _.each(this.model.models,function(pers) {
                 this.renderItem(pers);
            }, this);
            return this;
        },
        renderItem: function(taskItem) {
            var taskView = new TaskView({model: taskItem});
            
            this.$el.append(taskView.render().el);
        }
    });
    
  return TaskListView;
});
