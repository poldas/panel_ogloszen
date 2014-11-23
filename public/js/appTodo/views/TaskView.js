define(['jquery', 'underscore', 'backbone', 'modules/TaskItem'], function($, _, Backbone, TaskModel){
    var TaskView = Backbone.View.extend({
        template: _.template('<h3><%= title %></h3><p><%= created %></p>'),
        tagName: 'div',
        id: 'taks-view-id',
        className: 'taskView',
        initialize: function() {
          this.model.on('change', this.render, this);
          this.listenTo(this.model, 'remove', this.remove);
        },
        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },
        remove: function() {
            this.$el.remove();
        },
        events: {
            "click h3": "alertStatus"
        },
        alertStatus: function(e) {
            alert("hey tu h3");
        }
    });
    
  return TaskView;
});