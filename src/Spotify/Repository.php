<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Spotify;

use App\Spotify\Api\ApiFactory;
use App\Spotify\Api\ApiClient;

/**
 * Description of Repository
 *
 * @author salomon
 */
abstract class Repository implements RepositoryInterface {
	
	static public function getClient(): ApiClient {
		return ApiFactory::create();
	}
	
	static public function search(string $queryText): array {
		$response = static::getClient()->request('GET', '/search', [
			'query' => [
				'q' => $queryText,
				'type' => static::getEntityName(),
			],
		]);
		return static::mapList($response[static::getEntityName(true)]['items']);
	}
	
	/**
	 * 
	 * @param string $uri
	 * @param array $params
	 * @return array
	 */
	static public function getList(string $uri, array $params = []): array {
		$response = static::getClient()->request('GET', $uri, $params);
		return static::mapList($response['items']);
	}
	
	static protected function mapList(array $array): array {
		$className = static::getEntityClassName();
		$mappedItems = [];
		foreach($array as $item) {
			$mappedItems[] = new $className($item);
		}
		
		return $mappedItems;
	}
}
