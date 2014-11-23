define(['jquery', 'underscore', 'backbone'], function($, _, Backbone){
    var TaskView = Backbone.View.extend({
        render: function() {
            var html = '<h3>' + this.model.get('opis') + '</h3>';
            this.$el.html(html);
        }
    });
    
  return TaskView;
});