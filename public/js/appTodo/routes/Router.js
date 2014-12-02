define(['views/TestView', 'modules/TestModul','modules/TaskItem', 'collections/TaskCollection','views/TaskView', 'views/TaskListView'], 
function(TestView, TestModul, TaskModel, TaskCollection, TaskView, TaskListView) {
    var Router = Backbone.Router.extend({
        routes: {
          '': 'list',
          list: 'list',
          test: 'test'
        },
        test: function() {
            console.log('test');
            var testView  = new TestView({el: $('#test-form'), model: new TestModul()});
            testView.render();
            
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