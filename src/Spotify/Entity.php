<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Spotify;

/**
 * An abstraction for any spotify entity data, helpful to know what information
 * is available about it.
 *
 * @author salomon
 */
abstract class Entity {
	
	public function __construct(array $data) {
		
		foreach($this as $propertyName => $emptyValue) {
			$this->$propertyName = $data[$propertyName]??null;
		}
	}
}
