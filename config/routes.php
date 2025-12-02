<?php 

// Define routes
/* Home Page */
$router->get('/', 'HomeController@index');

/* Project Routes */
$router->get('/projects', 'ProjectController@index');
$router->get('/projects/create', 'ProjectController@create');
$router->post('/projects', 'ProjectController@store');

$router->get('/projects/{id}/show', 'ProjectController@show');
$router->get('/projects/{id}/edit', 'ProjectController@edit');
$router->post('/projects/{id}/update', 'ProjectController@update');
$router->post('/projects/{id}/delete', 'ProjectController@destroy');


