<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontController@index');
Route::get('/principal','FrontController@principal');
//Route::get('/users','FrontController@users');
//Route::get('/log','FrontController@log');
Route::get('/landing','FrontController@landing');
//Route::get('/prueba','ClienteController@prueba');

Route::resource('/cliente','ClienteController');
Route::get('/vercliente/{valor?}','ClienteController@agregado');//Hacer lo mismo que en el index pero con un parametro desde el inicio
Route::get('/filtrocliente/{valor?}','ClienteController@lista');//llamar a la funcion lista enviando parametro opcional
Route::resource('/personal','PersonalController');
Route::get('/verpersonal/{valor?}','PersonalController@agregado');//Hacer lo mismo que en el index pero con un parametro desde el inicio
Route::resource('/personalA','PersonalController@create');
Route::get('/filtropersonal/{valor?}','PersonalController@lista');//llamar a la funcion lista enviando parametro opcional
Route::resource('/inventario','InventarioController');
Route::resource('/inventarioA','InventarioController@create');
Route::get('/mensaje/{valor?}/{valor2?}','InventarioController@mensaje');//Deberia crear un controlador solo para esto ?
Route::get('/filtroinventario/{valor1?}/{valor2?}','InventarioController@lista');//llamar a la funcion lista enviando parametro opcional
Route::resource('/servicio','ServicioController');
Route::get('/filtroservicio/{valor?}','ServicioController@lista');//llamar a la funcion lista enviando parametro opcional
Route::resource('/reservacion','ReservacionController');
Route::get('/add','ReservacionController@listing');
Route::resource('pdf', 'PdfController');
Route::resource('reserva','ReservasController');
Route::get('/filtroreservas/{valor1?}/{valor2?}','ReservasController@lista');//llamar a la funcion lista enviando parametro opcional
Route::resource('/cargo','CargosController');

//usuario
Route::resource('/usuario','usuariocontroller');
Route::get('/userexist/{valor1}/{valor2}','usuariocontroller@existe');//verificar si existe el correo o el name
Route::get('/filtrousuario/{valor1?}/{valor2?}','usuariocontroller@lista');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
