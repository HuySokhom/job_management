app.config([
	'$stateProvider',
	'$urlRouterProvider',
	function($stateProvider, $urlRouterProvider) {
		$stateProvider.
			// route for product
			state('/job', {
				url: '/job',
				templateUrl: 'js/ng/app/job/views/index.html',
				controller: 'job_ctrl'
			})
			.state('/job/create', {
				url: '/job/create',
				templateUrl: 'js/ng/app/job/views/create.html',
				controller: 'job_create_ctrl'
			})
			.state('/job/edit', {
				url: '/job/edit/:id',
				templateUrl: 'js/ng/app/job/views/edit.html',
				controller: 'job_edit_ctrl'
			})

			// route for category
			.state('/category', {
				url: '/category',
				templateUrl: 'js/ng/app/category/views/index.html',
				controller: 'category_ctrl'
			})
			.state('/create', {
				url: '/category/create',
				templateUrl: 'js/ng/app/category/views/create.html',
				controller: 'create_ctrl'
			})
			.state('/edit', {
				url: '/category/edit/:id',
				templateUrl: 'js/ng/app/category/views/edit.html',
				controller: 'edit_ctrl'
			})
		;
		$urlRouterProvider.otherwise('/category');
	}
]);