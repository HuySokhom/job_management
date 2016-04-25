app.controller(
	'job_create_ctrl', [
	'$scope'
	, 'Restful'
	, '$location'
	, function ($scope, Restful, $location){
		'use strict';
		var url = 'api/job/saveJob';
		$scope.project = {
			description: 'Nuclear Missile Defense System',
			rate: 500
		};
		$scope.initCategory = function(){
			Restful.get('api/category/getCategory').success(function(data){
				$scope.categories = data;
			});
		};
		$scope.initCategory();
		$scope.save = function(){
			var data = {
				name: $scope.name,
				description: $scope.description,
				id_category: $scope.category_id,
				post_date: $scope.post_date,
				closing_date: $scope.closing_date
			};
			console.log(data);
			Restful.save( url , data).success(function (data) {
				console.log(data);
				$location.path('/job');
			});

		};

	}
]);