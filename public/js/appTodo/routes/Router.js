define(['modules/TaskItem', 'collections/TaskCollection','views/TaskView', 'views/TaskListView'], 
function(TaskModel, TaskCollection, TaskView, TaskListView) {
    var Router = Backbone.Router.extend({
        routes: {
          '': 'index',
          'home': 'home'
        },

        initialize: function() {
//            this.home();
        },
        index: function() {
            console.log('index');
        },
        home: function() {
            console.log('home');
            var tasklist = new TaskCollection();
            var tasklistview = new TaskListView({model: tasklist});
            tasklistview.render();
        }
    });
    return Router;
     
    return {
        initialize: initialize
    };
});