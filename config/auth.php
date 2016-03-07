<?php
return [

	'guards' => [
	    'api' => [
	        'driver' => 'jwt-auth',
	        'provider' => 'users'
	    ],

	    // ...
	],

	'providers' => [
	    'users' => [
	        'driver' => 'eloquent',
	        'model'  => App\User::class,
	    ],
	]
];