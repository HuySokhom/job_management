app.controller(
	'edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$location'
	, function ($scope, Restful, $stateParams, $location){
		'use strict';

		var url = 'api/category/getCategory/' + $stateParams.id;

		$scope.init = function(){
			Restful.get( url ).success(function (data) {
				console.log(data);
				$scope.category = data.data;
			});
		};
		$scope.init();
		$scope.save = function(){
			var data = {
				name: $scope.category.name,
				description: $scope.category.description
			};
			console.log(data);
			Restful.put( url , data).success(function (data) {
				console.log(data);
				$location.path('/category');
			});

		};
	}
]);