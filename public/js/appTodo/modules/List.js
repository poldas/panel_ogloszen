define(function() {
    var List = (function() {
        function List(params) {
            this.items = [];
        };
        
        List.prototype = {
            add: function(item) {
            	this.items.push(item);
            },
            find: function(callback, action){
            	var callbackReturn,
            	items = this.items,
            	length = items.length,
            	matches = [],
            	i = 0;
            	
            	for (i=0; i<length; i++) {
            		callbackReturn = callback(items[i], i);
            		if (callbackReturn) {
            			matches.push(items[i]);
            		}
            	}
            	
            	if (action) {
            		action.call(this, matches);
            	}
            	return matches;
            },
            remove: function(item) {
            	var indexOf = this.items.indexOf(item);
				if(indexOf !== -1) {
					this.items.splice(indexOf, 1);
				}
            }
        };
        
        return List;
    }());
    
    List.create = function(params) {
        return new List(params);
    }
    return List;
});