<?php
include 'api/ApiRequest.php';
include 'api/InitData.php';
include 'api/CalendrierClub.php';
include 'api/CalendrierDivision.php';
include 'api/InfosClub.php';
include 'api/Journee.php';
include 'api/Resultats.php';
include 'api/FeuilleMatch.php';
include 'api/ListeForce.php';
include 'api/FicheIndividuel.php';


use Slim\Http\Request;
use Slim\Http\Response;

// Routes
/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
*/
$app->get('/clubs', function (Request $request, Response $response, array $args) {
	$initData = new InitData();
	$clubs = $initData->getClubs();

	return $response
				->withJson($clubs)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/divisions', function (Request $request, Response $response, array $args) {
	$initData = new InitData();
	$clubs = $initData->getDivisions();

	return $response
				->withJson($clubs)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->get('/journee', function (Request $request, Response $response, array $args) {
	$initData = new Journee();
	$clubs = $initData->getJourneeActuelle();

	return $response
				->withJson($clubs)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$app->group('/calendrier', function () {
	$this->get('/club/{indice}', function (Request $request, Response $response, array $args) {
		$initData = new CalendrierClub($request->getAttribute('route')->getArgument('indice'));
		$clubs = $initData->getCalendrier();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	$this->get('/division/{indice}', function (Request $request, Response $response, array $args) {

		$initData = new CalendrierDivision($request->getAttribute('route')->getArgument('indice'));
		$clubs = $initData->getCalendrier();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});
	
});

$app->group('/club/{indice}', function () {
    $this->get('/infos', function ($request, $response, $args) {
		$infoClub = new InfosClub($request->getAttribute('route')->getArgument('indice'));
		$result = $infoClub->getInfoClub();

		return $response
				->withJson($result)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    });
    $this->get('/membres', function ($request, $response, $args) {
		$infoClub = new InfosClub($request->getAttribute('route')->getArgument('indice'));
		$result = $infoClub->getMembres();

		return $response
				->withJson($result)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');    });

    $this->get('/pratiques', function ($request, $response, $args) {
		$infoClub = new InfosClub($request->getAttribute('route')->getArgument('indice'));
		$result = $infoClub->getInfoPratique();

		return $response
				->withJson($result)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');    
            });

	$this->get('/calendrier', function (Request $request, Response $response, array $args) {
		$initData = new CalendrierClub($request->getAttribute('route')->getArgument('indice'));
		$clubs = $initData->getCalendrier();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});
	$this->get('/force', function (Request $request, Response $response, array $args) {
		$initData = new ListeForce($request->getAttribute('route')->getArgument('indice'));

		$hommes = $initData->getListeMessieurs();
		$dames = $initData->getListeDames();
		if(!is_array($dames)){
			$dames = [];
		}
		$clubs = array_merge($hommes, $dames);

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});
	
});

$app->group('/resultats', function () {

	$this->get('/division/{division}/{jour}', function (Request $request, Response $response, array $args) {
		$route = $request->getAttribute('route');
		$initData = new Resultats($route->getArgument('jour'), $route->getArgument('division'));
		$clubs = $initData->getResultats();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	$this->get('/match/{match}', function (Request $request, Response $response, array $args) {
		$route = $request->getAttribute('route');
		$initData = new FeuilleMatch($route->getArgument('match'));
		$clubs["matchs"] = $initData->getMatchs();
		$clubs["joueurs"] = $initData->getJoueurs();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	

});

$app->get('/classements/{division}/{jour}', function (Request $request, Response $response, array $args) {
	$route = $request->getAttribute('route');
	$initData = new Resultats($route->getArgument('jour'), $route->getArgument('division'));
	$clubs = $initData->getClassements();

	return $response
				->withJson($clubs)
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
	
$app->get('/proxy/clubid', function (Request $request, Response $response, array $args) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://competitie.vttl.be/?province=14&div_id=3491&menu=4&modif=0&detail=&list=&week_name=12&club_id=105&club_id=0");
	curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   

	// Fetch and return content, save it.
	$raw_data = curl_exec($ch);
	curl_close($ch);

	//https://competitie.vttl.be/?province=14&div_id=3491&menu=4&modif=0&detail=&list=&week_name=12&club_id=105&club_id=0
	$body = $response->getBody();
	$body->write($raw_data);
	return $response
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
$app->get('/proxy/stats/{division}/{num}', function (Request $request, Response $response, array $args) {
	$route = $request->getAttribute('route');
	$division = $route->getArgument('division');
	$num = $route->getArgument('num');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://competitie.vttl.be/?lang=fr&province=14&div_id=".$division."&menu=4&modif=0&detail=&list=&perteam=1&week_name=22&club_id=".$num);
	curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result   

	// Fetch and return content, save it.
	$raw_data = curl_exec($ch);
	curl_close($ch);

	//https://competitie.vttl.be/?province=14&div_id=3491&menu=4&modif=0&detail=&list=&week_name=12&club_id=105&club_id=0
	$body = $response->getBody();
	$body->write($raw_data);
	return $response
				->withHeader('Access-Control-Allow-Origin', '*')
            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->group('/joueur', function () {

	$this->get('/{licence}/victoires', function (Request $request, Response $response, array $args) {
		$route = $request->getAttribute('route');
		$initData = new FicheIndividuel($route->getArgument('licence'));
		$clubs = $initData->getVictoires();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	$this->get('/{licence}/defaites', function (Request $request, Response $response, array $args) {
		$route = $request->getAttribute('route');
		$initData = new FicheIndividuel($route->getArgument('licence'));
		$clubs = $initData->getDefaites();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	$this->get('/{licence}/infos', function (Request $request, Response $response, array $args) {
		$route = $request->getAttribute('route');
		$initData = new FicheIndividuel($route->getArgument('licence'));
		$clubs = $initData->getInfoJoueur();

		return $response
					->withJson($clubs)
					->withHeader('Access-Control-Allow-Origin', '*')
	            	->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});


});