define(['jquery', 'underscore', 'backbone'], function($, _, Backbone){
    var TaskItem = Backbone.Model.extend({
        defaults: {
            id: null,
            title: 'Napisz coś',
            completed: 0,
            created: ''
        }
    });
    
  return TaskItem;
});
