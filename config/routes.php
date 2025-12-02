<?php 

// Define routes
/* Home Page */
$router->get('/', 'HomeController@index');

/* Project Routes */
$router->get('/projects', 'ProjectController@index');
$router->get('/projects/create', 'ProjectController@create');
$router->post('/projects', 'ProjectController@store');

$router->get('/projects/show', 'ProjectController@show'); /* @TODO : add dynamic route {id} */
$router->get('/projects/edit', 'ProjectController@edit');
$router->post('/projects/update', 'ProjectController@update');
$router->post('/projects/delete', 'ProjectController@destroy');


