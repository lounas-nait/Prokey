<?php 

// Define routes
/* Home Page */
$router->get('/', 'HomeController@index');

/* Project Routes */
/* index */
$router->get('/projects', 'ProjectController@index');

/* create form */
$router->get('/projects/create', 'ProjectController@create');

/* store */
$router->post('/projects', 'ProjectController@store');

/* show */
$router->get('/projects/{id}/show', 'ProjectController@show');

/* edit form */
$router->get('/projects/{id}/edit', 'ProjectController@edit');

/* update */
$router->post('/projects/{id}/update', 'ProjectController@update');

/* delete */
$router->post('/projects/{id}/delete', 'ProjectController@destroy');


/* Password types Routes */
/* index */
$router->get('/password-types', 'PasswordTypeController@index');

/* create form */
$router->get('/password-types/create', 'PasswordTypeController@create');

/* store */
$router->post('/password-types', 'PasswordTypeController@store');

/* show */
$router->get('/password-types/{id}/show', 'PasswordTypeController@show');

/* edit form */
$router->get('/password-types/{id}/edit', 'PasswordTypeController@edit');

/* update */
$router->post('/password-types/{id}/update', 'PasswordTypeController@update');

/* delete */
$router->post('/password-types/{id}/delete', 'PasswordTypeController@destroy');