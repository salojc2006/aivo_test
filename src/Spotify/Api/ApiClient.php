<?php
declare(strict_types=1);

namespace App\Spotify\Api;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class ApiClient {
	
	private $clientId     = null;
	private $clientSecret = null;
	private $httpClient   = null;
	private $baseUri      = 'https://api.spotify.com/';
	private $token        = null;
	private $tokenType    = null;
	
	public function __construct(string $clientId, string $clientSecret) {
		$this->clientId     = $clientId;
		$this->clientSecret = $clientSecret;
		$this->httpClient   = new HttpClient(['base_uri' => $this->baseUri]);
	}
	
	public function getAccessToken() {
		if (empty($this->token)) {
			$client = new HttpClient(['base_uri'=>'https://accounts.spotify.com/api/']);
			try {
				$ret = $client->request('POST', 'token', [
					'auth' => [$this->clientId, $this->clientSecret],
					'headers' => [
						'Accept' => 'application/json',
					],
					'form_params' => [
						'grant_type' => 'client_credentials'
					]
				]);
			} catch (ClientException $e) {
				// prevent show message to end user
				// passing it trough third parameter allow trace error source.
				throw new ApiException('Authorization error', 0, $e);
			}
			$json = $ret->getBody()->getContents();
			$data = json_decode($json);
			// Could be stored on a database to avoid anoter call for each
			// end user query during token live. But in order to make a simple 
			// example, I leave it this way
			$this->token = $data->access_token;
			$this->tokenType = $data->token_type;
		}
	}
	
	public function request(string $method, string $uri, array $options = []): array {
		$this->getAccessToken();
		try {
			$return = $this->httpClient->request($method, '/v1' . $uri, array_merge($options, [
				'headers' => [
					'Authorization' => "{$this->tokenType} {$this->token}",
					'Accept'        => 'application/json',
				],
			]));
		} catch (RequestException $e) {
			// Ever time catch and throw another exception, bind to original 
			// though third param to trace it if necessary.
			if ($e->getResponse()->getStatusCode() == 404) {
				throw new ResourceNotFound("Requested resource was not found on Spotify" . $e->getRequest()->getUri(), 0, $e);
			}
			// avoid show inaccurate message to end user
			throw new ApiException('An error was occured', 0, $e);
		}
		$json = $return->getBody()->getContents();
		$data = json_decode($json, true);
		return $data;
	}
}

