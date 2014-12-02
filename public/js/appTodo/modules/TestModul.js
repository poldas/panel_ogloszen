define(['jquery', 'underscore', 'backbone'], function($, _, Backbone){
    var TestModul = Backbone.Model.extend({
        validation: {
            'ogloszenie[cena]' : {
                required: true,
                pattern: 'number'
            },
            'ogloszenie[model]' : {
                required: true
            }
        }
    });
    
  return TestModul;
});
