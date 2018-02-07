<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;
//get all cards
$app->get('/cards', function(Request $request, Response $response) {
    try {
        $cardObj = new Card();
        $cards = $cardObj->get(['status', '=', Config::get('status/active')]);
        echo json_encode($cards);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get total cards
$app->get('/cards/total', function(Request $request, Response $response) {
    try {
        $cardObj = new Card();
        $total = $cardObj->getTotal();
        $total = ['total' => $total];
        echo json_encode($total);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});

//get particular card
$app->get('/cards/{id}', function(Request $request, Response $response) {
    try {
        $id = $request->getAttribute('id');
        $cardObj = new Card();
        $card = $cardObj->get(['id', '=', $id, 'status', '=', Config::get('status/active')]);
        echo json_encode($card);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get all categories
$app->get('/categories', function(Request $request, Response $response) {
    try {
        $categoryObj = new Categories();
        $categories = $categoryObj->get(['status', '=', Config::get('status/active')]);
        echo json_encode($categories);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get all cards in a category
$app->get('/categories/{id}/cards', function(Request $request, Response $response) {
    try {
        $category = $request->getAttribute('id');
        $cardObj = new Card();
        $card = $cardObj->get(['category', '=', $category, 'status', '=', Config::get('status/active')]);
        echo json_encode($card);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});