NGApp.factory( 'PexCardService', function( $resource, $http, $routeParams ) {

	var service = { 'status': { 'OPEN': 'OPEN', 'BLOCKED': 'BLOCKED' } };

	var pexcard = $resource( App.service + 'pexcard/:action/', { action: '@action' }, {
		'pex_id' : { 'method': 'POST', params : { action: 'pex-id' } },
		'admin_pexcard' : { 'method': 'POST', params : { action: 'admin-pexcard' } },
		'driver_search' : { 'method': 'POST', params : { action: 'driver-search' } },
		'driver_active' : { 'method': 'POST', params : { action: 'driver-active' } },
		'add_funds' : { 'method': 'POST', params : { action: 'add-funds' } },
		'admin_pexcard_remove' : { 'method': 'POST', params : { action: 'admin-pexcard-remove' } },
		'pex_change_card_status' : { 'method': 'POST', params : { action: 'pexcard-change-card-status' } },
		'report' : { 'method': 'POST', params : { action: 'report' } }
	}	);

	service.pex_id = function( id, callback ){
		pexcard.pex_id( { 'id': id }, function( data ){
			callback( data );
		} );
	}

	service.driver_search = function( params, callback ){
		pexcard.driver_search( params, function( data ){
			callback( data );
		} );
	}

	service.report = function( params, callback ){
		pexcard.report( params, function( data ){
			callback( data );
		} );
	}

	service.add_funds = function( params, callback ){
		pexcard.add_funds( params, function( data ){
			callback( data );
		} );
	}

	service.pex_change_card_status = function( params, callback ){
		pexcard.pex_change_card_status( params, function( data ){
			callback( data );
		} );
	}

	service.driver_active = function( id_pexcard, callback ){
		pexcard.driver_active( { 'id_pexcard': id_pexcard }, function( data ){
			callback( data );
		} );
	}

	service.admin_pexcard = function( params, callback ){
		pexcard.admin_pexcard( params, function( data ){
			callback( data );
		} );
	}

	service.admin_pexcard_remove = function( id_pexcard, callback ){
		pexcard.admin_pexcard_remove( { id_pexcard: id_pexcard }, function( data ){
			callback( data );
		} );
	}

	return service;

} );