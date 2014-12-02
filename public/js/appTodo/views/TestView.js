define(
['handlebars', 'text!templates/TodoView.html', 'jquery', 'underscore', 'backbone', 'modules/TaskItem', 'lib/backbone.validation'], 
function(Handlebars, TodoViewTpl, $, _, Backbone, TaskModel){
    var TaskView = Backbone.View.extend({
        events: {
            "submit": "save",
            "change input": "changed",
            "change select": "changed"
        },
        initialize: function() {
            // 
//          _.bindAll(this, this.save);
          this.model.bind('change', this.changed);
          Backbone.Validation.bind(this);
        },
        render: function() {
            $(this.el).append("<button id='add'>Add list item</button>");
            return this;
        },
        save: function(e) {
            console.log(e);
            e.preventDefault();
            var arr = this.$el.serializeArray();
            console.log(arr );
            var data = _(arr).reduce(function(acc, field) {
              acc[field.name] = field.value;
              return acc;
            }, {});
            console.log(data);
            this.model.set(data);
            console.log(this.model);
            if (this.model.isValid(true)) {
                console.log('ok jest');
            } else {
                console.log('nie ok jest');
            }
            return true;
        },
        changed:function(evt) {
            var changed = evt.currentTarget;
            var $changed = $(evt.currentTarget);
            var value = $(evt.currentTarget).val();
            var obj = {};
            obj[$changed.attr('name')] = value;
            this.model.set(obj);
            console.log(obj, 'console.log(this.model);');
         }
    });
    
  return TaskView;
});

