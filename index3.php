<?php
require_once("vendor/autoload.php");
use Slim\App;
use Slim\Container;

$setting = array(
"setting" => array(
"displayErrorDetails" => true

)

);

$container = new Container($setting);
$app = new App($container);

$app->get("/", function($request, $response){
    $parameter = $request->getQueryParams();
    $jurusan = $parameter["jurusan"];
    $result = array(
        "nama" => $parameter["nama"],
        "kelas" => $parameter["kelas"],
        "jurusan" => $jurusan
    );
    return $response->withJson($result);
});

$app->post("/post", function($request, $response){
    $parameter = $request->getParsedBody();
    $lantai3 = $parameter["lantai3"];
    $result = array(
        "lantai1" => $parameter["lantai1"],
        "lantai2" => $parameter["lantai2"],
        "lantai3" => $lantai3
    );
    return $response->withJson($result);
});
$app->run();