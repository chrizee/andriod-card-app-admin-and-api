<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
//get all cards
$app->get('/api/cards', function(Request $request, Response $response) {
    try {
        $cardObj = new Card();
        $cards = $cardObj->getTotal();
        print_r($cards);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});