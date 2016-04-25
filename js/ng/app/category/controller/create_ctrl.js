app.controller(
	'create_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		'use strict';
		var url = 'api/category/saveCategory';

		$scope.save = function(){
			var data = {
				name: $scope.category_name,
				description: $scope.description
			};
			Restful.save( url , data).success(function (data) {
				console.log(data);
				$location.path('/category');
			});

		};

	}
]);