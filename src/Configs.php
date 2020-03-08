<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of Configs
 *
 * @author salomon
 */
class Configs {
	
	static public $configs = [
		'spotify' => [
			'clientId'     => '07786a3a483447da93e71b21ca6fde90',
			'clientSecret' => '7f61f9e7160a4044b806113d15df5104',
		],
	];
	
	static public function get(string $name)  {
		if (!isset(static::$configs[$name])) {
			throw new Exception("Configuration set for '{$name}' not found");
		}
		return static::$configs[$name];
	}
}
