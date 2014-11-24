define(
['jquery', 'underscore', 'backbone', 'views/TaskView', 'text!templates/TodoListView.html', 'handlebars'], 
function($, _, Backbone, TaskView, TodoListViewTpl, Handlebars){
    'use strict';
    var TaskListView = Backbone.View.extend({
        template: Handlebars.compile(TodoListViewTpl),
        el: $('#task-list table tbody'),
        initialize: function() {
          this.model.on('add', this.renderItem, this);
          this.render();
        },
        render: function() {
            _.each(this.model.models,function(TaskView) {
                 this.renderItem(TaskView);
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
