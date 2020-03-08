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
class Albums extends Repository {
	
	static public function getEntityName(bool $plural = false): string {
		return $plural ? 'albums' : 'album';
	}
	
	static public function getEntityClassName(): string {
		return Album::class;
	}
	
	static public function getByArtistId(string $artistId): array {
		return static::getList("/artists/{$artistId}/albums");
	}
	
}
