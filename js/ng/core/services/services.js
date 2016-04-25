app.service("Services", [
    'Restful'
	, function(Restful) {
        var services = function(){
            var self = this;
        };

        services.prototype.dateTime = function(){
            var date_validate = {
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: false,
                showAnim: ''
            };
            return date_validate;
        };

        services.prototype.alertMessage = function(title, message, type){
            $.notify({
                title: '<b>' + title + '</b>',
                message: message
            },{
                type: type
            });
        };

        return services;
        
 	}
]);
/**
 * AngularJS default filter with the following expression:
 * "person in people | filter: {name: $select.search, age: $select.search}"
 * performs a AND between 'name: $select.search' and 'age: $select.search'.
 * We want to perform a OR.
 */
app.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            items.forEach(function(item) {
                var itemMatches = false;

                var keys = Object.keys(props);
                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    }
});