<?php


require 'vendor/autoload.php';

//tablas
use App\ModelaCademic_area AS ModelaCademic_area;
use App\ModelAdmin_area As ModelAdmin_area;
use App\ModelAreas AS ModelAreas;

use Bramus\Router\Router as RouterRouter;

$router = new RouterRouter();
// Define routes
// ...

//RUTAS PARA ACADEMIC_AREAS

$router->mount('/academic_areas', function() use ($router) {

    $router->get('/', function() {
        ModelaCademic_area::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelaCademic_area::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelaCademic_area::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "area": 1,
            "staff": 2,
            "position": 2,
            "journeys" : 2
        }
    
    */

    $router->post('/', function(){
        ModelaCademic_area::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelaCademic_area::update($id , json_decode(file_get_contents('php://input'), true));
    });

});


//RUTAS PARA ADMIN_AREA

$router->mount('/admin_areas', function() use ($router) {

    $router->get('/', function() {
        ModelAdmin_area::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelAdmin_area::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelAdmin_area::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "area": 1,
            "staff": 2,
            "position": 2,
            "journeys" : 2
        }
    
    */

    $router->post('/', function(){
        ModelAdmin_area::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelAdmin_area::update($id , json_decode(file_get_contents('php://input'), true));
    });

});


//RUTAS PARA AREAS

$router->mount('/areas', function() use ($router) {

    $router->get('/', function() {
        ModelAreas::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelAreas::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelAreas::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "area": 1,
            "staff": 2,
            "position": 2,
            "journeys" : 2
        }
    
    */

    $router->post('/', function(){
        ModelAreas::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelAreas::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

//RUTAS PARA CAMPERS


$router->mount('/areas', function() use ($router) {

    $router->get('/', function() {
        ModelAreas::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelAreas::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelAreas::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "area": 1,
            "staff": 2,
            "position": 2,
            "journeys" : 2
        }
    
    */

    $router->post('/', function(){
        ModelAreas::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelAreas::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

$router->get('/', function() {  
    echo 'inicio';
});
// Run it!
$router->run();