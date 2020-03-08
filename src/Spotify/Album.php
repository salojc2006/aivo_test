<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Spotify;

/**
 * Description of Album
 *
 * @author salomon
 */
class Album extends Entity {
	
	public $name;
	public $released;
	public $tracks;
	public $cover = [
		'width'  => 0,
		'height' => 0,
		'url'    => '',
	];
	
	public function __construct(array $data) {
		$this->name     = $data['name'         ];
		$this->released = $data['release_date'];
		$this->tracks   = $data['total_tracks' ];
		if (isset($data['images'][0])) {
			$this->cover = $data['images'][0];
		}
	}
}
