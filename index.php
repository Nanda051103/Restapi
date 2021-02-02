<?php

require_once("vendor/autoload.php");
require_once("Connection.php");
use Slim\App;
use Slim\Container;

$setting = array(
"setting" => array(
"displayErrorDetails" => true

)

);

$container = new Container($setting);
$app = new App($container);


$app->get("/siswa/all", function($request, $response)
{
    $db = new Connection();
    $query = "SELECT * FROM siswa";
    $daftar_siswa = $db->fetchAll($query, []);
    return $response->withJson($daftar_siswa);
});

$app->get("/siswa/detail", function($request, $response){
    $db = new Connection();
    $params = $request->getQueryParams();
    $id_siswa = $params['id_siswa'];
    $args = array(":id" => $id_siswa);
    $query = "SELECT * FROM siswa WHERE id = :id";
    $siswa = $db->fetch($query, $args);
    return $response->withJson($siswa);
});

$app->post("/siswa/add", function($request, $response){
    $db = new Connection();
    $params = $request->getParsedBody();
    $query = "INSERT INTO siswa (nama, siswa, sekolah) VALUES (:nama, :siswa, :sekolah)";
    $args = [
        ":nama" => $params["nama"],
        ":siswa" => $params["siswa"],
        ":sekolah" => $params["sekolah"]
    ];
    $db->execute($query, $args);
    return $response->withJson(["message" =>  "success !"]);
    });

$app->post("/siswa/edit", function($request, $response){
    $db = new Connection();
    $params = $request->getParsedBody();
    $query = "UPDATE siswa SET nama = :nama,siswa = :siswa,sekolah = :sekolah WHERE id = :id";
    $args = [
        ":nama" => $params['nama'],
        ":siswa" => $params['siswa'],
        ":sekolah" => $params['sekolah'],
        ":id" => $params['id']
    ];
    $db->execute($query, $args);
    return $response->withJson(["message" =>  "success !"]);
    });   
    
    $app->post("/siswa/dalate", function($request, $response){
        $db = new Connection();
        $params = $request->getParseBody();
        $query = "DELETE FROM siswa WHERE id = :id";
        $args = [
            ":id" => $params ['id']
        ];
        $db->execute($query, $args);
        return $response->withJson(["messege" => "Success !"]);
    });


$app->run();