<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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
//get total in a category
$app->get('/cards/{id}/total', function(Request $request, Response $response) {
    try {
        $id = $request->getAttribute('id');
        $cardObj = new Card();
        $total = $cardObj->getTotal($id);
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
//get particular category
$app->get('/categories/{id}', function(Request $request, Response $response) {
    try {
        $id = $request->getAttribute('id');
        $categoryObj = new Categories();
        $category = $categoryObj->get(['id', '=', $id, 'status', '=', Config::get('status/active')]);
        echo json_encode($category);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get subcategories in a category
$app->get('/categories/{id}/subcategories', function(Request $request, Response $response) {
    try {
        $parent = $request->getAttribute('id');
        $subCategoryObj = new SubCategories();
        $categories = $subCategoryObj->get(['parent', '=', $parent, 'status', '=', Config::get('status/active')]);
        echo json_encode($categories);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get all cards in a subcategory
$app->get('/subcategories/{id}', function(Request $request, Response $response) {
    try {
        $id = $request->getAttribute('id');
        $cardObj = new Card();
        $cards = $cardObj->get(['sub_category', '=', $id, 'status', '=', Config::get('status/active')]);
        echo json_encode($cards);
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
//get all cards in a category not in a sub category
$app->get('/categories/{id}/main', function(Request $request, Response $response) {
    try {
        $category = $request->getAttribute('id');
        $cardObj = new Card();
        $card = $cardObj->get(['category', '=', $category, 'sub_category', '=', '0', 'status', '=', Config::get('status/active')]);
        echo json_encode($card);
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});
//get link to other apps
$app->get('/link', function(Request $request, Response $response) {
    try {
        $category = $request->getAttribute('id');
        $linkObj = new Link();
        $link = $linkObj->get([1, '=', 1]);
        if(!empty($link)) {
            $link = ['link' => $link[0]->link];
            echo json_encode($link);
        }
    } catch(PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'} }';
    }
});