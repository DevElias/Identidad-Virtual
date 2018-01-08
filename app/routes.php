<?php 

$route[] = ['/', 'LoginController@index'];
$route[] = ['/home', 'HomeController@index'];
$route[] = ['/logout', 'LoginController@logout'];
$route[] = ['/paises', 'PaisesController@index'];
$route[] = ['/paises/{id}/show', 'PaisesController@show'];
$route[] = ['/pessoa/{id}/{sexo}/{idade}', 'PaisesController@teste'];

return $route;