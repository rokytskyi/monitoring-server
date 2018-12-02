<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';

require '../../config.php';

$app = new \Slim\App(['settings' => $config]);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/slow', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Slow response");
    sleep(10);
    return $response;
});

$app->get('/very_slow', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Very slow response");
    sleep(20);
    return $response;
});

$app->get('/internal_error', function (Request $request, Response $response, array $args) {

    return $response->withStatus(500, "Internal server error");
});

$app->get('/unauthorized', function (Request $request, Response $response, array $args) {

    return $response->withStatus(401, "Unauthorized");
});

$app->get('/unauthorized_two', function (Request $request, Response $response, array $args) {

    return $response->withStatus(401, "Unauthorized");
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello world");

    return $response;
});

$app->post('/create_smth', function (Request $request, Response $response, array $args) {
    return $response->withStatus(200, "Created");
});

$app->put('/save_smth', function (Request $request, Response $response, array $args) {
    return $response->withStatus(200, "Saved");
});

$app->run();