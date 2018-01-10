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

return $route;