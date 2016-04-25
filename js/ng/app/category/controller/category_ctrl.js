app.controller(
	'category_ctrl', [
	'$scope'
	, 'Restful'
	, function ($scope, Restful){
		'use strict';
		$scope.init = function(){
			Restful.get('api/category/getCategory').success(function(data){
				$scope.categories = data;console.log(data);
			});
		};
		$scope.init();
		$scope.remove = function(id){
			if (confirm('Are you sure you want to this category?')) {
				Restful.delete('api/category/deleteCategory/' + id).success(function(data){
					$scope.init();
				});
			}
		};
	}
]);