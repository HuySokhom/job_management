app.controller(
	'job_edit_ctrl', [
	'$scope'
	, 'Restful'
	, '$stateParams'
	, '$location'
	, function ($scope, Restful, $stateParams, $location){
		'use strict';

		var url = 'api/job/getJob/' + $stateParams.id;

		$scope.init = function(){
			Restful.get( url ).success(function (data) {
				console.log(data);
				$scope.job = angular.copy(data);
			});
			Restful.get('api/category/getCategory').success(function(data){
				$scope.categories = data;console.log(data);
			});
		};
		$scope.init();
		$scope.save = function(){
			var data = {
				name: $scope.job.name,
				id_category: $scope.job.category_id,
				post_date: $scope.job.post_date,
				closing_date: $scope.job.closing_date,
				description: $scope.job.description
			};
			console.log(data);
			Restful.put( url , data).success(function (data) {
				console.log(data);
				$location.path('/job');
			});

		};
	}
]);