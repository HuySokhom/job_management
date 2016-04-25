app.factory("Restful", [
 	'$http',
 	function ($http) {
        var obj = {};
        // start get 
        obj.get = function(url, params) {
            return $http({
        		url: url,
    			method: 'GET',
				//cache : true,
    			params: params
            });
        };

		obj.save = function(url, params) {
			return $http({
				url: url,
				method: 'POST',
				cache : false,
				data: params
			});
		};

        obj.put = function(url, params){
        	return $http({
        		url: url,
    			method: 'PUT',
    			data: params
        	});
        };
        
        obj.patch = function(url, params){
        	return $http({
        		url: url,
    			method: 'PATCH',
    			data: params
        	});
        };
        
        obj.delete = function(url, params){
        	return $http({
        		url: url,
    			method: 'DELETE',
    			data: params
        	});
        };

        return obj;
        
 	}
]);
