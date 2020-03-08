<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Spotify\Api;

use App\Configs;

/**
 * Description of ApiFactory
 *
 * @author salomon
 */
class ApiFactory {
	
	static private $instance = null;
	
	static public function create(): ApiClient {
		
		// It is not a singleton patter, but I want keep just unique instance.
		// If not may use an argument to decide keep existent o get a new.
		if (!static::$instance) {
			// @todo: get it from an environment configuration file or a wallet.
			// Ever possible, try not take it from Framework configuation file
			// so implemented a App\Configs class..

			$configs      = Configs::get('spotify');
			$clientId     = $configs['clientId'    ];
			$clientSecret = $configs['clientSecret'];

			static::$instance = new ApiClient($clientId, $clientSecret); 
		}
		
		return static::$instance;
	}
}
