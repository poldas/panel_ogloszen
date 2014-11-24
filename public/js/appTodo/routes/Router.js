define(['modules/TaskItem', 'collections/TaskCollection','views/TaskView', 'views/TaskListView'], 
function(TaskModel, TaskCollection, TaskView, TaskListView) {
    var Router = Backbone.Router.extend({
        routes: {
          '': 'list',
          list: 'list'
        },

        initialize: function() {
//            this.home();
        },
        index: function() {
            console.log('index');
        },
        list: function() {
            console.log('home');
            var tasklist = new TaskCollection({model: TaskModel});
            var tasklistview = new TaskListView({model: tasklist});
            tasklistview.render();
        }
    });
    return Router;
     
    return {
        initialize: initialize
    };
});