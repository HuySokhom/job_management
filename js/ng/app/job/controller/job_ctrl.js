app.controller(
	'job_ctrl', [
	'$scope'
	, 'Restful'
	, function ($scope, Restful){
		'use strict';
		var url = 'api/job/getJob';
		$scope.init = function(params){
			Restful.get(url, params).success(function(data){
				$scope.jobs = data;console.log(data);
			});
		};
		$scope.init();
		$scope.remove = function(id){
			if (confirm('Are you sure you want to this job?')) {
				Restful.delete('api/job/deleteJob/' + id).success(function(data){
					$scope.init();
					console.log(data);
				})
				.error(function (data, status, header, config) {
					console.log(data);
				});
			}
		};
	}
]);