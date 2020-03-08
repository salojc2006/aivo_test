<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Spotify;

use App\Exception;

/**
 * Description of Artist
 *
 * @author salomon
 */
class Artists extends Repository {
	
	static public function getEntityName(bool $plural = false): string {
		return $plural ? 'artists' : 'artist';
	}
	
	static public function getEntityClassName(): string {
		return Artist::class;
	}
	
	static public function getById(string $id): array {
		return static::getClient()->request('GET', "/artists/{$id}");
	}
	
	static public function getAlbumsByArtistName(string $name): array {
		$response = static::search($name);
		
		if (!count($response)) {
			throw new Exception('Artist was not found');
		}
		// Take the first. I was'n found a way to get one by exactly name.
		$artistId = $response[0]->id;
		return Albums::getByArtistId($artistId);
	}
	
}
