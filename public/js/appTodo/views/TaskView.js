define(
['handlebars', 'text!templates/TodoView.html', 'jquery', 'underscore', 'backbone', 'modules/TaskItem'], 
function(Handlebars, TodoViewTpl, $, _, Backbone, TaskModel){
    var TaskView = Backbone.View.extend({
        template: Handlebars.compile(TodoViewTpl),
        tagName: 'tr',
        initialize: function() {
          this.model.on('change', this.render, this);
          this.listenTo(this.model, 'remove', this.remove);
        },
        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
            
            // render example
            // This is method that can be called
            // once an object is init. You could 
            // also do this in the initialize event
//            var source = $('#PersonTemplate').html();
//            var template = Handlebars.compile(source);
//            var html = template(this.model.toJSON());
//            this.$el.html(html)
//            return this;
        },
        remove: function() {
            this.$el.remove();
        },
        onEnter: function( evt ) {
            if ( evt.which == 13 ) this.alertStatus();
        },
        events: {
            "click h3": "alertStatus"
        },
        alertStatus: function(e) {
//            alert("hey tu h3");
        }
    });
    
  return TaskView;
});