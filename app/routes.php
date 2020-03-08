<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use App\Spotify\Artists;

return function (App $app) {
	
    $app->get('/albums', function (Request $request, Response $response, $args) {
		$query = $request->getQueryParams();
		if (empty($query['q'])) {
			$newResponse = $response->withStatus(400, 'Missing \'q\' query param');
			return $newResponse;
		}
		$content = Artists::getAlbumsByArtistName($query['q']);
		
		$newResponse = $response->withAddedHeader('Content-Type', 'application/json');
		$newResponse->getBody()->write(json_encode($content));
		return $response;
    });
};
