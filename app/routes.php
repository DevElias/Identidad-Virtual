<?php 

/*Login Controller*/
$route[] = ['/', 'LoginController@index'];
$route[] = ['/logout', 'LoginController@logout'];

/*Home Controller*/
$route[] = ['/home', 'HomeController@index'];

/*Paises Controller*/
$route[] = ['/pais', 'PaisesController@index'];
$route[] = ['/pais/add', 'PaisesController@add'];
$route[] = ['/pais/save', 'PaisesController@save'];
$route[] = ['/pais/edit', 'PaisesController@edit'];
$route[] = ['/pais/delete/{id}', 'PaisesController@delete'];
$route[] = ['/pais/show/{id}', 'PaisesController@show'];

/* API Paises */
$route[] = ['/pais?api=true', 'PaisesController@index'];

/*Areas Controller*/
$route[] = ['/area', 'AreasController@index'];
$route[] = ['/area/add', 'AreasController@add'];
$route[] = ['/area/save', 'AreasController@save'];
$route[] = ['/area/edit', 'AreasController@edit'];
$route[] = ['/area/delete/{id}', 'AreasController@delete'];
$route[] = ['/area/show/{id}', 'AreasController@show'];

/* API Areas */
$route[] = ['/are?api=true', 'AreasController@index'];

return $route;