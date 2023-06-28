<?php

header("Access-Control-Allow-Origin: *"); // Permite el acceso desde cualquier origen. Puedes especificar un origen específico en lugar de '*' si es necesario.
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT"); // Especifica los métodos HTTP permitidos.
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

require 'vendor/autoload.php';



//tablas
use App\ModelaCademic_area AS ModelaCademic_area;
use App\ModelAdmin_area As ModelAdmin_area;
use App\ModelAreas AS ModelAreas;
use App\ModelSubjects AS ModelSubjects;
use App\ModelCountries AS ModelCountries;
use App\ModelRegions AS ModelRegions;
use App\ModelCities AS ModelCities;
use App\ModelStaff AS ModelStaff;
use App\ModelJourney AS ModelJourney;
use App\ModelLevels AS ModelLevels;
use App\Modellocations AS Modellocations;

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
            "name_area": 1
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

//RUTAS PARA SUBJECT


$router->mount('/subjects', function() use ($router) {

    $router->get('/', function() {
        ModelSubjects::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelSubjects::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelSubjects::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_subject": "materia 1"
        }
    
    */

    $router->post('/', function(){
        ModelSubjects::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelSubjects::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

//para countries

$router->mount('/country', function() use ($router) {

    $router->get('/', function() {
        ModelCountries::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelCountries::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelCountries::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_country": "country"
        }
    
    */

    $router->post('/', function(){
        ModelCountries::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelCountries::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

//Regiones

$router->mount('/regions', function() use ($router) {

    $router->get('/', function() {
        ModelRegions::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelRegions::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelRegions::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_region": "Santander",
            "country": 2
        }
    
    */

    $router->post('/', function(){
        ModelRegions::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelRegions::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

//cities


$router->mount('/cities', function() use ($router) {

    $router->get('/', function() {
        ModelCities::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelCities::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelCities::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_city": "Santander",
            "region": 2
        }
    
    */

    $router->post('/', function(){
        ModelCities::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelCities::update($id , json_decode(file_get_contents('php://input'), true));
    });

});


//staff

$router->mount('/staff', function() use ($router) {

    $router->get('/', function() {
        ModelStaff::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelStaff::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelStaff::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
{
                    "doc": inputs[0].value,
                    "first_name": inputs[1].value,
                    "second_name": inputs[2].value,
                    "first_surname": inputs[3].value,
                    "second_surname": inputs[4].value,
                    "eps": inputs[5].value,
                    "area": selects[0].value,
                    "city": selects[1].value
                  }
    
    */

    $router->post('/', function(){
        ModelStaff::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelStaff::update($id , json_decode(file_get_contents('php://input'), true));
    });


});


//journey


$router->mount('/journeys', function() use ($router) {

    $router->get('/', function() {
        ModelJourney::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelJourney::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelJourney::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_journey": "tarde",
            "check_in": time,
            "check_out": time,
        }
    
    */

    $router->post('/', function(){
        ModelJourney::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelJourney::update($id , json_decode(file_get_contents('php://input'), true));
    });

});


//levels


$router->mount('/levels', function() use ($router) {

    $router->get('/', function() {
        ModelLevels::getall();
    });

    $router->get('/(\d+)', function($id) {
        ModelLevels::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        ModelLevels::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_level": "tarde",
            "group_level": time,
        }
    
    */

    $router->post('/', function(){
        ModelLevels::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        ModelLevels::update($id , json_decode(file_get_contents('php://input'), true));
    });

});

//locations


$router->mount('/locations', function() use ($router) {

    $router->get('/', function() {
        Modellocations::getall();
    });

    $router->get('/(\d+)', function($id) {
        Modellocations::getid($id);
    });

    $router->delete('/(\d+)', function($id){
        Modellocations::delete($id);
    });

    /* 
        para post y put el objeto a recibir es
        {
            "name_level": "tarde",
            "group_level": time,
        }
    
    */

    $router->post('/', function(){
        Modellocations::post(json_decode(file_get_contents('php://input'), true));
    });

    $router->match('PUT|PATCH','/(\d+)', function($id){
        Modellocations::update($id , json_decode(file_get_contents('php://input'), true));
    });

});



$router->get('/', function() {  
    echo 'inicio';
});
// Run it!
$router->run();