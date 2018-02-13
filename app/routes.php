<?php 

/*Login Controller*/
$route[] = ['/', 'LoginController@index'];
$route[] = ['/logout', 'LoginController@logout'];

/*Home Controller*/
$route[] = ['/home', 'HomeController@index'];
$route[] = ['/home/save', 'HomeController@save'];

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
$route[] = ['/area?api=true', 'AreasController@index'];

/*Cargos Controller*/
$route[] = ['/cargo', 'CargosController@index'];
$route[] = ['/cargo/add', 'CargosController@add'];
$route[] = ['/cargo/save', 'CargosController@save'];
$route[] = ['/cargo/edit', 'CargosController@edit'];
$route[] = ['/cargo/delete/{id}', 'CargosController@delete'];
$route[] = ['/cargo/show/{id}', 'CargosController@show'];

/* API Cargos */
$route[] = ['/cargo?api=true', 'CargosController@index'];

/*Sedes Controller*/
$route[] = ['/sede', 'SedesController@index'];
$route[] = ['/sede/add', 'SedesController@add'];
$route[] = ['/sede/save', 'SedesController@save'];
$route[] = ['/sede/edit', 'SedesController@edit'];
$route[] = ['/sede/delete/{id}', 'SedesController@delete'];
$route[] = ['/sede/show/{id}', 'SedesController@show'];

/* API Sedes */
$route[] = ['/sede?api=true', 'SedesController@index'];

/*Usuarios Controller*/
$route[] = ['/usuario', 'UsuariosController@index'];
$route[] = ['/usuario/delete/{id}', 'UsuariosController@delete'];
$route[] = ['/usuario/edit', 'UsuariosController@edit'];
$route[] = ['/usuario/show/{id}', 'UsuariosController@show'];

/* API Usuarios */
$route[] = ['/usuario?api=true', 'UsuariosController@index'];

/*Solicitud de Correo Controller*/
$route[] = ['/correo', 'CorreosController@index'];
$route[] = ['/correo/crear', 'CorreosController@crear'];
$route[] = ['/correo/nickname', 'CorreosController@nickname'];
$route[] = ['/correo/modificar', 'CorreosController@modificar'];
$route[] = ['/correo/recuperar', 'CorreosController@recuperar'];
$route[] = ['/correo/suspender', 'CorreosController@suspender'];
$route[] = ['/correo/eliminar', 'CorreosController@eliminar'];
$route[] = ['/correo/transferir', 'CorreosController@transferir'];
$route[] = ['/correo/concluir', 'CorreosController@concluir'];
$route[] = ['/correo/listado', 'CorreosController@listado'];
$route[] = ['/correo/show/{id}', 'CorreosController@show'];
$route[] = ['/correo/aprobado/{id}', 'CorreosController@aprobar'];
$route[] = ['/correo/reprobado/{id}', 'CorreosController@reprobado'];
$route[] = ['/correo/exportar', 'CorreosController@exportar'];
$route[] = ['/correo/edit', 'CorreosController@edit'];
$route[] = ['/correo/check', 'CorreosController@check'];
$route[] = ['/correo/SearchSede', 'CorreosController@SearchSede'];
$route[] = ['/correo/history', 'CorreosController@history'];

/*Import XLS to database*/
$route[] = ['/import', 'ImportController@index'];

/*Status Menu dataBase*/
$route[] = ['/menu/status', 'MenuController@StatusMenu'];
$route[] = ['/menu/change', 'MenuController@ChangeStatus'];

/*Region Controller*/
$route[] = ['/region', 'RegionController@index'];
$route[] = ['/region/add', 'RegionController@add'];
$route[] = ['/region/save', 'RegionController@save'];
$route[] = ['/region/edit', 'RegionController@edit'];
$route[] = ['/region/delete/{id}', 'RegionController@delete'];
$route[] = ['/region/show/{id}', 'RegionController@show'];

/*Menus*/
$route[] = ['/menu_idvirtual', 'MenuController@home'];

return $route;