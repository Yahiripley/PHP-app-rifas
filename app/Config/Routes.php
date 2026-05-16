<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# "URL" , "Archivo Controlador PHP:: funcion" 
$routes->get('/', 'Home::index');


$routes->get('/saludar', 'Home::saludar');

$routes->get('/saludar2/(:alpha)/(:num)', 'Home::saludar2/$1/$2'); 

# (:num), (:alpha), (:segment), o (:any)


$routes->get('/calculadora','Calculadora::index');

$routes->post('/calculadora/sumar','Calculadora::sumar');

$routes->post('/calculadora/calcular'
               ,'Calculadora::calcular');

$routes->get('/usuariotest', 'Home::usuarioTest');


$routes->group("usuarios", function($routes){
 
    #GET Mostrar usuarios (VIEW)  
    $routes->get("", "UsuarioController::index");   #"localhost:8080/usuarios/"

    #GET Mostar usuario {id} (VIEW)
    $routes->get("(:num)", "UsuarioController::show/$1");  #"localhost:8080/usuarios/5"

    #GET mostrar formulario para agregar usuario (VIEW)
    $routes->get("create", "UsuarioController::create"); 
    #POST accion: crear usuario  (redicrecciona -> usuarios/{id})
    $routes->post("store", "UsuarioController::store");

    #GET Mostrar formulario para editar usuario {id} (VIEW)
    $routes->get("edit/(:num)", "UsuarioController::edit/$1"); 
    #POST Accion: actualizar info del usuario {id} en la base de datos (Redireccion -> /usuarios)
    $routes->post("update/(:num)", "UsuarioController::update/$1");

    #POST accion: eliminar usuario {id}
    $routes->post("delete/(:num)", "UsuarioController::delete/$1");

    #GET mostrar login
    $routes->get("login", "UsuarioController::login");
    #post accion: validar login
    $routes->post("auth", "UsuarioController::auth");
    #get accion: logout
    $routes->get("logout", "UsuarioController::logout");

    $routes->get("activar/(:num)/(:num)", "UsuarioController::activar/$1/$2");

});


$routes->group("rifas", function($routes){
    $routes->get("", "RifaController::index");
    $routes->get("catalogo", "RifaController::catalogo");
    $routes->get("(:num)", "RifaController::show/$1");
    $routes->get("create", "RifaController::create");
    $routes->post("store", "RifaController::store");
    $routes->get("edit/(:num)", "RifaController::edit/$1");
    $routes->post("update/(:num)", "RifaController::update/$1");
    $routes->post("delete/(:num)", "RifaController::delete/$1");
    $routes->post("comprar/(:num)/(:num)", "RifaController::comprar/$1/$2");
    $routes->post("simular/(:num)", "RifaController::simular/$1");
});




 
